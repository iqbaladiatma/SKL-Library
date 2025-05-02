<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $borrowedBooks = Loan::where('user_id', Auth::id())
            ->whereNull('actual_balik_at')
            ->with('book')
            ->get();
        $totalBorrowed = $borrowedBooks->count();
        $dueSoon = $borrowedBooks->where('balik_at', '<=', now()->addDays(2))->where('balik_at', '>=', now())->count();
        $overdue = $borrowedBooks->where('balik_at', '<', now())->count();

        return view('dashboard', compact('borrowedBooks', 'totalBorrowed', 'dueSoon', 'overdue'));
    }

    public function extend(Request $request, $loanId)
    {
        $request->validate([
            'balik_at' => 'required|date',
        ]);

        $loan = Loan::where('user_id', Auth::id())->findOrFail($loanId);
        $loan->balik_at = $request->balik_at; // 🆕 tanggal yang dipilih
        $loan->save();

        return redirect()->back()->with('success', 'Masa pinjam diperpanjang.');
    }


    public function return(Request $request, $loanId)
    {
        $request->validate([
            'balik_at' => 'required|date',
        ]);

        $loan = Loan::where('user_id', Auth::id())->findOrFail($loanId);
        $book = $loan->book;

        // Naikkan stok
        $book->increment('stock');

        // Tandai sudah dikembalikan
        $loan->actual_balik_at = $request->balik_at; // 🆕 tanggal yang dipilih
        $loan->save();

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
