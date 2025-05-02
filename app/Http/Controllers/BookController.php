<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class BookController extends Controller
{
    public function __construct()
    {
        // Terapkan middleware auth untuk metode borrow
        $this->middleware('auth')->only(['borrow']);
    }

    // Menampilkan daftar buku (halaman Books)
    public function index(Request $request)
    {
        // Cek apakah ada query pencarian
        $search = $request->input('search');

        // Jika ada query pencarian, cari buku berdasarkan judul atau penulis
        if ($search) {
            $books = Book::where('title', 'like', '%' . $search . '%')
                         ->orWhere('author', 'like', '%' . $search . '%')
                         ->paginate(6);
        } else {
            // Jika tidak ada pencarian, tampilkan semua buku
            $books = Book::paginate(6);
        }

        return view('books', compact('books', 'search'));
    }

    // Menampilkan detail buku
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('book-details', compact('book'));
    }

    // Meminjam buku
    public function borrow(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        // Cek apakah stok tersedia
        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis.');
        }

        // Cek apakah user sudah meminjam buku ini
        $existingLoan = Loan::where('user_id', Auth::id())
            ->where('book_id', $id)
            ->whereNull('actual_balik_at')
            ->exists();
        if ($existingLoan) {
            return redirect()->back()->with('error', 'Anda sudah meminjam buku ini.');
        }

        // Kurangi stok dan buat record peminjaman
        $book->decrement('stock');

        // Pastikan book_id diisi dengan benar
        Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id, // Pastikan kolom book_id diisi dengan benar
            'pinjam_at' => now(),
            'balik_at' => now()->addDays(7), // Masa pinjam 7 hari
        ]);

        return redirect()->route('dashboard')->with('success', 'Buku berhasil dipinjam.');
    }
}
