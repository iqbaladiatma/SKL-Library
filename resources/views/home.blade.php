@extends('layouts.app')

@section('title', 'eLibrary - Digital Library Platform')
@section('content')
<div class="bg-gradient-to-b from-emerald-900 to-teal-900 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <div class="space-y-6">
                <h1 class="text-5xl sm:text-6xl font-bold text-white mb-4 animate-fade-in-down">
                    Welcome to <span class="bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">eLibrary</span>
                </h1>
                <p class="text-xl text-emerald-100 max-w-3xl mx-auto mb-8">
                    Platform perpustakaan digital modern dengan koleksi buku premium dan gratis. Baca online atau download PDF, semua dalam satu tempat.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('books.index') }}"
                        class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-xl hover:scale-105 transition-transform duration-200 shadow-lg shadow-emerald-500/30">
                        Jelajahi Koleksi
                    </a>
                    <a href="{{ route('books.index', ['filter' => 'premium']) }}"
                        class="px-8 py-4 bg-gradient-to-r from-yellow-500 to-orange-500 text-white font-semibold rounded-xl hover:scale-105 transition-transform duration-200 shadow-lg shadow-yellow-500/30">
                        Buku Premium
                    </a>
                </div>
            </div>
        </div>

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden opacity-20">
            <div class="absolute -top-20 -left-20 w-96 h-96 bg-teal-500/30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-1/3 right-0 w-64 h-64 bg-emerald-500/30 rounded-full blur-3xl animate-pulse delay-1000"></div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-white mb-12 text-center">Fitur Unggulan eLibrary</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white/5 p-6 rounded-2xl border border-white/10 text-center">
                <div class="w-16 h-16 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Baca PDF Online</h3>
                <p class="text-emerald-200">Baca file PDF langsung di browser tanpa perlu download</p>
            </div>
            <div class="bg-white/5 p-6 rounded-2xl border border-white/10 text-center">
                <div class="w-16 h-16 bg-yellow-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Konten Premium</h3>
                <p class="text-emerald-200">Akses buku premium dengan sistem pembelian yang aman</p>
            </div>
            <div class="bg-white/5 p-6 rounded-2xl border border-white/10 text-center">
                <div class="w-16 h-16 bg-blue-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">Pinjam Gratis</h3>
                <p class="text-emerald-200">Pinjam buku gratis dengan sistem peminjaman yang fleksibel</p>
            </div>
        </div>
    </div>

    @if($search)
    <!-- Search Results Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-white mb-8">
            Hasil Pencarian untuk "{{ $query }}"
            <span class="text-emerald-400 text-lg block sm:inline mt-2 sm:mt-0">({{ $featuredBooks->total() }} hasil ditemukan)</span>
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredBooks as $book)
            <div class="bg-white/5 rounded-2xl p-6 border border-white/10 hover:border-emerald-400/30 transition-all duration-300 h-full">
                <div class="relative mb-4 overflow-hidden rounded-xl aspect-[3/4]">
                    <img
                        src="{{ $book->cover_image_url }}"
                        alt="{{ $book->title }}"
                        class="w-full h-full object-cover transform hover:scale-105 transition duration-300">
                    @if($book->is_premium)
                    <div class="absolute top-2 left-2">
                        <span class="bg-yellow-500 text-yellow-900 px-2 py-1 rounded-full text-xs font-bold">
                            PREMIUM
                        </span>
                    </div>
                    @endif
                </div>
                <h3 class="font-bold text-white mb-1 truncate">{{ $book->title }}</h3>
                <p class="text-emerald-200 text-sm mb-3">{{ $book->author }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium {{ $book->stock > 0 ? 'text-green-400' : 'text-red-400' }}">
                        {{ $book->stock > 0 ? 'Tersedia' : 'Dipinjam' }}
                    </span>
                    @if($book->is_premium)
                    <span class="text-yellow-400 text-sm font-bold">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                    @endif
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('books.show', $book->id) }}" class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $featuredBooks->appends(['q' => $query])->links() }}
        </div>
    </div>
    @else
    <!-- Featured Books Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-white mb-8" data-aos="fade-up">Koleksi Unggulan 📚</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="flip-left">
            @foreach($featuredBooks as $book)
            <div class="group transform hover:-translate-y-2 transition-all duration-300">
                <div class="bg-white/5 rounded-2xl p-6 border border-white/10 hover:border-emerald-400/30 h-full">
                    <div class="relative mb-4 overflow-hidden rounded-xl aspect-[3/4]">
                        <img
                            src="{{ $book->cover_image_url }}"
                            alt="{{ $book->title }}"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300">
                        @if($book->is_premium)
                        <div class="absolute top-2 left-2">
                            <span class="bg-yellow-500 text-yellow-900 px-2 py-1 rounded-full text-xs font-bold">
                                PREMIUM
                            </span>
                        </div>
                        @endif
                    </div>
                    <h3 class="font-bold text-white mb-1 truncate">{{ $book->title }}</h3>
                    <p class="text-emerald-200 text-sm mb-3">{{ $book->author }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium {{ $book->stock > 0 ? 'text-green-400' : 'text-red-400' }}">
                            {{ $book->stock > 0 ? 'Tersedia' : 'Dipinjam' }}
                        </span>
                        @if($book->is_premium)
                        <span class="text-yellow-400 text-sm font-bold">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <a href="{{ route('books.show', $book->id) }}" class="text-sm font-medium text-emerald-400 hover:text-emerald-300 transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('books.index') }}" class="inline-block bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-8 py-4 rounded-xl hover:scale-105 transition-transform duration-200 shadow-lg shadow-emerald-500/30">
                Lihat Semua Buku
            </a>
        </div>
    </div>
    @endif

    <!-- CTA Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-gradient-to-r from-emerald-500/20 to-teal-500/20 rounded-3xl p-12 text-center border border-emerald-500/30">
            <h2 class="text-4xl font-bold text-white mb-6">Bergabung dengan eLibrary</h2>
            <p class="text-xl text-emerald-100 mb-8 max-w-2xl mx-auto">
                Dapatkan akses ke ribuan buku digital, fitur pembacaan yang nyaman, dan komunitas pembaca yang aktif.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                <a href="{{ route('dashboard') }}" class="bg-white text-emerald-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition-colors">
                    Dashboard Saya
                </a>
                @else
                <a href="{{ route('register') }}" class="bg-white text-emerald-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition-colors">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="bg-transparent text-white border-2 border-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-emerald-600 transition-colors">
                    Masuk
                </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fade-in-down {
        animation: fadeInDown 1s ease-out;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection