@extends('layouts.app')

@section('title', 'Detail Buku')
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </button>
            </a>

            <div class="flex flex-col lg:flex-row gap-8" data-aos="zoom-in-left">
                <div class="lg:w-1/3">
                <img 
                            src="{{ asset('storage/' . $book->image) }}" 
                            alt="Book Cover"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300"
                        >
                </div>
                
                <div class="lg:w-2/3 space-y-6">
                    <h1 class="text-4xl font-bold text-white">{{ $book->title }}</h1>
                    <p class="text-emerald-300 text-xl">Oleh {{ $book->author }}</p>
                    
                    <div class="bg-white/5 p-6 rounded-xl border border-white/10">
                        <h3 class="text-xl font-semibold text-white mb-4">Sinopsis</h3>
                        <p class="text-emerald-200 leading-relaxed">{{ $book->description }}</p>
                    </div>

                    <div class="flex flex-wrap gap-4 items-center justify-between">
                        <div class="bg-white/5 px-6 py-3 rounded-xl border border-white/10">
                            <span class="{{ $book->stock > 0 ? 'text-emerald-400' : 'text-red-400' }} font-medium">
                                Stok Tersedia: {{ $book->stock }}
                            </span>
                        </div>

                        @auth
                        <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-emerald-500/90 text-white px-8 py-4 rounded-xl hover:bg-emerald-600 transition-colors flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Pinjam Buku
                            </button>
                        </form>
                        @else
                        <div class="bg-red-500/20 text-red-300 px-6 py-3 rounded-xl border border-red-500/30">
                            Silakan <a href="{{ route('login') }}" class="underline hover:text-red-400">login</a> untuk meminjam
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection