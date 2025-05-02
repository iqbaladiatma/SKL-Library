@extends('layouts.app')

@section('title', 'eLibrary - Home')
@section('content')
<div class="bg-gradient-to-b from-emerald-900 to-teal-900 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <div class="space-y-6">
                <h1 class="text-5xl sm:text-6xl font-bold text-white mb-4 animate-fade-in-down">
                    Discover <span class="bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">Literary Treasures</span>
                </h1>
                <p class="text-xl text-emerald-100 max-w-3xl mx-auto mb-8">
                    Jelajahi koleksi kami, kelola rak digital Anda, dan bergabunglah dengan komunitas pembaca kami.
                </p>
                <form action="{{ route('home') }}" method="GET" class="flex flex-col sm:flex-row gap-4 max-w-2xl mx-auto">
                    <div class="flex-1 relative">
                        <input 
                            type="text" 
                            name="q" 
                            class="w-full p-4 rounded-xl bg-white/10 backdrop-blur-lg border border-white/20 text-white placeholder-emerald-200 focus:ring-2 focus:ring-emerald-400 transition-all"
                            placeholder="Cari judul, penulis, atau genre..." 
                            value="{{ $query ?? '' }}"
                        >
                        <svg class="absolute right-4 top-4 h-6 w-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <button 
                        type="submit" 
                        class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-xl hover:scale-105 transition-transform duration-200 shadow-lg shadow-emerald-500/30"
                    >
                        Cari Sekarang
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden opacity-20">
            <div class="absolute -top-20 -left-20 w-96 h-96 bg-teal-500/30 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-1/3 right-0 w-64 h-64 bg-emerald-500/30 rounded-full blur-3xl animate-pulse delay-1000"></div>
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
                            src="{{ asset('storage/' . $book->image) }}" 
                            alt="{{ $book->title }}" 
                            class="w-full h-full object-cover transform hover:scale-105 transition duration-300"
                        >
                    </div>
                    <h3 class="font-bold text-white mb-1 truncate">{{ $book->title }}</h3>
                    <p class="text-emerald-200 text-sm mb-3">{{ $book->author }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium {{ $book->stock > 0 ? 'text-green-400' : 'text-red-400' }}">
                            {{ $book->stock > 0 ? 'Tersedia' : 'Dipinjam' }}
                        </span>
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
                                src="{{ asset('storage/' . $book->image) }}" 
                                alt="{{ $book->title }}" 
                                class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300"
                            >
                        </div>
                        <h3 class="font-bold text-white mb-1 truncate">{{ $book->title }}</h3>
                        <p class="text-emerald-200 text-sm mb-3">{{ $book->author }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium {{ $book->stock > 0 ? 'text-green-400' : 'text-red-400' }}">
                                {{ $book->stock > 0 ? 'Tersedia' : 'Dipinjam' }}
                            </span>
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
        </div>

        <!-- CTA Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16" data-aos="zoom-in-down">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-3xl p-8 text-center">
                <div class="max-w-2xl mx-auto">
                    <h2 class="text-3xl font-bold text-white mb-4">
                        {{ Auth::check() ? 'Lanjutkan Petualangan Membaca' : 'Mulai Membaca Hari Ini' }}
                    </h2>
                    <p class="text-emerald-100 mb-8">
                        {{ Auth::check() ? 'Temukan bacaan terbaru Anda' : 'Bergabung dengan ribuan pembaca kami' }}
                    </p>
                    @if (Auth::check())
                        <a href="{{ route('dashboard') }}" class="inline-block bg-white text-emerald-600 px-8 py-3 rounded-xl font-semibold hover:bg-opacity-90 transition">
                            Ke Dashboard →
                        </a>
                    @else
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('register') }}" class="inline-block bg-white text-emerald-600 px-8 py-3 rounded-xl font-semibold hover:bg-opacity-90 transition">
                                Daftar Gratis
                            </a>
                            <a href="{{ route('login') }}" class="inline-block bg-black/20 text-white px-8 py-3 rounded-xl font-semibold hover:bg-black/30 transition">
                                Member Existing
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .animate-fade-in-down {
        animation: fadeInDown 1s ease-out;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .pagination {
        @apply flex justify-center mt-8;
    }
    
    .pagination li {
        @apply mx-1;
    }
    
    .pagination a,
    .pagination span {
        @apply px-4 py-2 rounded-lg bg-white/10 text-white hover:bg-emerald-500 transition;
    }
    
    .pagination .active span {
        @apply bg-emerald-500 text-white;
    }
</style>
@endsection