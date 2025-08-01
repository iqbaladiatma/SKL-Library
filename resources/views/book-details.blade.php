@extends('layouts.app')

@section('title', $book->title . ' - eLibrary')

@section('content')
<div class="bg-gradient-to-b from-emerald-900 to-teal-900 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Notifications -->
        @if (session('success'))
        <div class="bg-emerald-500/20 text-emerald-200 p-4 rounded-xl mb-8 border border-emerald-500/30">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="bg-red-500/20 text-red-200 p-4 rounded-xl mb-8 border border-red-500/30">
            {{ session('error') }}
        </div>
        @endif

        <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-white/10">
            <a href="{{ route('books.index') }}" class="inline-block mb-8">
                <button class="bg-emerald-500/90 text-white px-6 py-3 rounded-xl hover:bg-emerald-600 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </button>
            </a>

            <div class="flex flex-col lg:flex-row gap-8" data-aos="zoom-in-left">
                <div class="lg:w-1/3">
                    <div class="relative">
                        <img
                            src="{{ $book->cover_image_url }}"
                            alt="Book Cover"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300 rounded-lg shadow-lg">

                        @if($book->is_premium)
                        <div class="absolute top-4 right-4">
                            <span class="bg-yellow-500 text-yellow-900 px-3 py-1 rounded-full text-sm font-bold flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                PREMIUM
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="lg:w-2/3 space-y-6">
                    <div>
                        <h1 class="text-4xl font-bold text-white">{{ $book->title }}</h1>
                        <p class="text-emerald-300 text-xl">Oleh {{ $book->author }}</p>

                        @if($book->category)
                        <span class="inline-block bg-emerald-500/20 text-emerald-300 px-3 py-1 rounded-full text-sm mt-2">
                            {{ $book->category }}
                        </span>
                        @endif
                    </div>

                    <div class="bg-white/5 p-6 rounded-xl border border-white/10">
                        <h3 class="text-xl font-semibold text-white mb-4">Sinopsis</h3>
                        <p class="text-emerald-200 leading-relaxed">{{ $book->description }}</p>
                    </div>

                    <!-- Book Details -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @if($book->published_year)
                        <div class="bg-white/5 p-4 rounded-xl border border-white/10 text-center">
                            <p class="text-emerald-300 text-sm">Tahun Terbit</p>
                            <p class="text-white font-semibold">{{ $book->published_year }}</p>
                        </div>
                        @endif

                        @if($book->pages)
                        <div class="bg-white/5 p-4 rounded-xl border border-white/10 text-center">
                            <p class="text-emerald-300 text-sm">Halaman</p>
                            <p class="text-white font-semibold">{{ $book->pages }}</p>
                        </div>
                        @endif

                        @if($book->language)
                        <div class="bg-white/5 p-4 rounded-xl border border-white/10 text-center">
                            <p class="text-emerald-300 text-sm">Bahasa</p>
                            <p class="text-white font-semibold">{{ $book->language }}</p>
                        </div>
                        @endif

                        @if($book->isbn)
                        <div class="bg-white/5 p-4 rounded-xl border border-white/10 text-center">
                            <p class="text-emerald-300 text-sm">ISBN</p>
                            <p class="text-white font-semibold text-xs">{{ $book->isbn }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-4 items-center justify-between">
                        <div class="bg-white/5 px-6 py-3 rounded-xl border border-white/10">
                            <span class="{{ $book->stock > 0 ? 'text-emerald-400' : 'text-red-400' }} font-medium">
                                Stok Tersedia: {{ $book->stock }}
                            </span>
                        </div>

                        @auth
                        @if($book->is_premium)
                        <!-- Premium Book Actions -->
                        @if($hasPurchased)
                        <!-- User sudah membeli buku premium -->
                        <div class="flex gap-3">
                            @if($book->content)
                            <a href="{{ route('books.read', $book->id) }}" class="bg-emerald-500/90 text-white px-8 py-4 rounded-xl hover:bg-emerald-600 transition-colors flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                Baca Online
                            </a>
                            @endif
                            <div class="bg-green-500/20 text-green-300 px-6 py-4 rounded-xl border border-green-500/30">
                                <span class="text-sm">Sudah Dibeli</span>
                            </div>
                        </div>
                        @else
                        <!-- User belum membeli buku premium -->
                        <div class="flex gap-3 items-center">
                            <div class="bg-yellow-500/20 text-yellow-300 px-6 py-4 rounded-xl border border-yellow-500/30">
                                <span class="text-lg font-bold">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                            </div>
                            <form action="{{ route('books.purchase', $book->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-yellow-500/90 text-yellow-900 px-8 py-4 rounded-xl hover:bg-yellow-600 transition-colors flex items-center gap-2 font-bold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                    </svg>
                                    Beli Sekarang
                                </button>
                            </form>
                        </div>
                        @endif
                        @else
                        <!-- Free Book Actions -->
                        @if($hasLoaned)
                        <!-- User sudah meminjam buku ini -->
                        <div class="flex gap-3">
                            @if($book->content)
                            <a href="{{ route('books.read', $book->id) }}" class="bg-emerald-500/90 text-white px-8 py-4 rounded-xl hover:bg-emerald-600 transition-colors flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                Baca Online
                            </a>
                            @endif
                            <div class="bg-emerald-500/20 text-emerald-300 px-6 py-4 rounded-xl border border-emerald-500/30">
                                <span class="text-sm">Sudah Dipinjam</span>
                            </div>
                        </div>
                        @else
                        <!-- User belum meminjam buku ini -->
                        <button type="button" onclick="openLoanModal()" class="bg-emerald-500/90 text-white px-8 py-4 rounded-xl hover:bg-emerald-600 transition-colors flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Pinjam Buku
                        </button>
                        @endif
                        @endif
                        @else
                        <div class="bg-gray-500/20 text-gray-300 px-6 py-4 rounded-xl border border-gray-500/30">
                            <span class="text-sm">Login untuk mengakses buku</span>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="loanModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
    <div class="bg-white/20 backdrop-blur-lg p-8 rounded-2xl border border-white/20 max-w-md w-full mx-4 shadow-2xl">
        <h3 class="text-2xl font-bold text-white mb-6 text-center">Pilih Durasi Peminjaman</h3>

        <form action="{{ route('books.borrow', $book->id) }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-white font-semibold mb-3 text-lg">Durasi Peminjaman</label>
                <select name="duration" class="w-full bg-white/20 border border-white/30 rounded-xl px-4 py-4 text-white focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-400/50 text-lg font-medium">
                    <option value="7" class="bg-gray-800 text-white">7 Hari</option>
                    <option value="14" class="bg-gray-800 text-white">14 Hari</option>
                    <option value="30" class="bg-gray-800 text-white">30 Hari</option>
                </select>
                @error('duration')
                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button type="button" onclick="closeLoanModal()" class="flex-1 bg-gray-500/50 text-white px-6 py-3 rounded-xl hover:bg-gray-600/50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="flex-1 bg-emerald-500/90 text-white px-6 py-3 rounded-xl hover:bg-emerald-600 transition-colors">
                    Pinjam
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openLoanModal() {
        document.getElementById('loanModal').classList.remove('hidden');
        document.getElementById('loanModal').classList.add('flex');
    }

    function closeLoanModal() {
        document.getElementById('loanModal').classList.add('hidden');
        document.getElementById('loanModal').classList.remove('flex');
    }

    // Close modal when clicking outside
    document.getElementById('loanModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLoanModal();
        }
    });
</script>
@endsection