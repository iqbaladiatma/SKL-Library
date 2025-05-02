@extends('layouts.app')

@section('title', 'Books')

@section('content')
<div class="bg-gradient-to-b from-emerald-900 to-teal-900 min-h-screen py-12"> 
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12" data-aos="fade-down"> 
            <h2 class="text-4xl font-bold text-white mb-4 animate-fade-in-down">
                Koleksi Perpustakaan
            </h2>
            <p class="text-emerald-200 text-lg max-w-2xl mx-auto">
                Jelajahi ribuan buku digital dari berbagai genre dan penulis ternama
            </p>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('books.index') }}" class="mb-16" data-aos="fade-right">
            <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-lg rounded-full px-6 py-4 border border-emerald-300 max-w-2xl mx-auto">
                <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ old('search', $search) }}" 
                    placeholder="Cari judul atau penulis..."
                    class="flex-1 bg-transparent outline-none placeholder-emerald-300 text-white text-lg"
                />
                <button type="submit" class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-full px-8 py-3 hover:scale-105 transition-transform shadow-lg border border-emerald-500 shadow-emerald-500/30">
                    Cari
                </button>
            </div>
        </form>

        <!-- Books Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-aos="zoom-in">
            @foreach ($books as $book)
            <div class="bg-white/5 rounded-2xl p-6 border border-white/10 hover:border-emerald-400/30 transition-all duration-300 group h-full">
                <div class="flex flex-col h-full" data-aos="zoom-in">
                    <div class="relative overflow-hidden rounded-xl mb-4 aspect-[3/4]">
                        <img 
                            src="{{ asset('storage/' . $book->image) }}" 
                            alt="Book Cover"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300"
                        >
                        <div class="absolute bottom-2 right-2 bg-black/50 text-white px-3 py-1 rounded-full text-xs font-medium">
                            Stok: {{ $book->stock }}
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-white mb-2 truncate">{{ $book->title }}</h3>
                        <p class="text-emerald-300 text-sm font-medium mb-3">Oleh {{ $book->author }}</p>
                        <p class="text-emerald-200 text-sm mb-4 line-clamp-3">{{ $book->description }}</p>
                    </div>

                    <div class="flex space-x-3 mt-auto">
                        <form action="{{ route('books.borrow', $book->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-emerald-500/90 text-white px-4 py-3 rounded-xl hover:bg-emerald-600 transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Pinjam
                            </button>
                        </form>
                        <a href="{{ route('books.show', $book->id) }}" class="flex-1 text-center border-2 border-emerald-500 text-emerald-300 px-4 py-3 rounded-xl hover:bg-emerald-500/10 transition-colors">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
           {{ $books->links() }}
        </div>
    </div>
</div>

<style>
    .animate-fade-in-down {
        animation: fadeInDown 1s ease-out;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection