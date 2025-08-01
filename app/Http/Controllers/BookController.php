<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\BookPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function __construct()
    {
        // Terapkan middleware auth untuk metode borrow, read, dan purchase
        $this->middleware('auth')->only(['borrow', 'read', 'purchase']);
    }

    // Menampilkan daftar buku (halaman Books)
    public function index(Request $request)
    {
        // Cek apakah ada query pencarian
        $search = $request->input('search');
        $category = $request->input('category');
        $filter = $request->input('filter', 'all');

        $query = Book::query();

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($category) {
            $query->where('category', $category);
        }

        // Filter berdasarkan tipe konten
        if ($filter === 'free') {
            $query->where('is_premium', false);
        } elseif ($filter === 'premium') {
            $query->where('is_premium', true);
        }

        $books = $query->paginate(20);
        $categories = Book::distinct()->pluck('category')->filter();

        return view('books', compact('books', 'search', 'category', 'filter', 'categories'));
    }

    // Menampilkan detail buku
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $user = Auth::user();
        $hasPurchased = $user ? $book->isPurchasedByUser($user->id) : false;
        $hasLoaned = $user ? $book->loans()->where('user_id', $user->id)->whereNull('actual_balik_at')->exists() : false;

        return view('book-details', compact('book', 'hasPurchased', 'hasLoaned'));
    }

    // Membeli buku premium
    public function purchase(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $user = Auth::user();

        // Cek apakah buku premium
        if (!$book->is_premium) {
            return redirect()->back()->with('error', 'Buku ini gratis dan tidak perlu dibeli.');
        }

        // Cek apakah sudah dibeli
        if ($book->isPurchasedByUser($user->id)) {
            return redirect()->back()->with('error', 'Anda sudah membeli buku ini.');
        }

        // Cek saldo
        if ($user->balance < $book->price) {
            return redirect()->back()->with('error', 'Saldo tidak cukup. Saldo Anda: Rp ' . number_format($user->balance, 0, ',', '.') . ', Harga buku: Rp ' . number_format($book->price, 0, ',', '.'));
        }

        try {
            // Kurangi saldo user
            DB::table('users')->where('id', $user->id)->decrement('balance', $book->price);

            // Buat record pembelian
            BookPurchase::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'amount_paid' => $book->price,
                'payment_method' => 'balance',
                'transaction_id' => 'TXN' . time() . $user->id
            ]);

            return redirect()->route('books.show', $book->id)->with('success', 'Buku berhasil dibeli! Anda sekarang dapat membaca buku ini.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membeli buku. Silakan coba lagi.');
        }
    }

    // Meminjam buku
    public function borrow(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'duration' => 'required|integer|in:7,14,30'
        ], [
            'duration.required' => 'Durasi peminjaman harus dipilih.',
            'duration.integer' => 'Durasi harus berupa angka.',
            'duration.in' => 'Durasi yang dipilih tidak valid.'
        ]);

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

        // Ambil durasi dari request
        $duration = (int) $request->input('duration', 7);

        try {
            // Kurangi stok dan buat record peminjaman
            $book->decrement('stock');

            // Pastikan book_id diisi dengan benar
            Loan::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'pinjam_at' => now(),
                'balik_at' => now()->addDays($duration),
            ]);

            return redirect()->route('dashboard')->with('success', 'Buku berhasil dipinjam! Harap dikembalikan pada ' . now()->addDays($duration)->format('d F Y'));
        } catch (\Exception $e) {
            // Rollback jika terjadi error
            $book->increment('stock');
            return redirect()->back()->with('error', 'Terjadi kesalahan saat meminjam buku. Silakan coba lagi.');
        }
    }

    // Membaca buku (untuk buku yang dipinjam atau dibeli)
    public function read($id)
    {
        $book = Book::findOrFail($id);
        $user = Auth::user();

        // Cek apakah user meminjam buku ini
        $loan = Loan::where('user_id', $user->id)
            ->where('book_id', $id)
            ->whereNull('actual_balik_at')
            ->first();

        // Cek apakah user membeli buku ini (untuk buku premium)
        $hasPurchased = $book->isPurchasedByUser($user->id);

        if (!$loan && !$hasPurchased) {
            if ($book->is_premium) {
                return redirect()->back()->with('error', 'Anda harus membeli buku ini terlebih dahulu untuk membacanya.');
            } else {
                return redirect()->back()->with('error', 'Anda harus meminjam buku ini terlebih dahulu untuk membacanya.');
            }
        }

        return view('book-read', compact('book', 'loan', 'hasPurchased'));
    }
}
