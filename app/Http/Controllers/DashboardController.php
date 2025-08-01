<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\BookPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Borrowed books
        $borrowedBooks = Loan::where('user_id', $user->id)
            ->whereNull('actual_balik_at')
            ->with('book')
            ->get();
        $totalBorrowed = $borrowedBooks->count();
        $dueSoon = $borrowedBooks->where('balik_at', '<=', now()->addDays(2))->where('balik_at', '>=', now())->count();
        $overdue = $borrowedBooks->where('balik_at', '<', now())->count();

        // Purchased books
        $purchasedBooks = BookPurchase::where('user_id', $user->id)
            ->with('book')
            ->orderBy('purchase_date', 'desc')
            ->get();
        $totalPurchased = $purchasedBooks->count();

        return view('dashboard', compact(
            'user',
            'borrowedBooks',
            'totalBorrowed',
            'dueSoon',
            'overdue',
            'purchasedBooks',
            'totalPurchased'
        ));
    }

    public function extend(Request $request, $loanId)
    {
        $request->validate([
            'balik_at' => 'required|date|after:now',
        ], [
            'balik_at.required' => 'Tanggal perpanjangan harus diisi.',
            'balik_at.date' => 'Format tanggal tidak valid.',
            'balik_at.after' => 'Tanggal perpanjangan harus setelah hari ini.'
        ]);

        try {
            $loan = Loan::where('user_id', Auth::id())->findOrFail($loanId);

            // Cek apakah buku sudah dikembalikan
            if ($loan->actual_balik_at) {
                return redirect()->back()->with('error', 'Buku sudah dikembalikan, tidak bisa diperpanjang.');
            }

            $loan->balik_at = $request->balik_at;
            $loan->save();

            return redirect()->back()->with('success', 'Masa pinjam berhasil diperpanjang hingga ' . \Carbon\Carbon::parse($request->balik_at)->format('d F Y'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperpanjang masa pinjam. Silakan coba lagi.');
        }
    }

    public function return(Request $request, $loanId)
    {
        $request->validate([
            'balik_at' => 'required|date',
        ], [
            'balik_at.required' => 'Tanggal pengembalian harus diisi.',
            'balik_at.date' => 'Format tanggal tidak valid.'
        ]);

        try {
            $loan = Loan::where('user_id', Auth::id())->findOrFail($loanId);

            // Cek apakah buku sudah dikembalikan
            if ($loan->actual_balik_at) {
                return redirect()->back()->with('error', 'Buku sudah dikembalikan sebelumnya.');
            }

            $book = $loan->book;

            // Naikkan stok
            $book->increment('stock');

            // Tandai sudah dikembalikan
            $loan->actual_balik_at = $request->balik_at;
            $loan->save();

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengembalikan buku. Silakan coba lagi.');
        }
    }
}
