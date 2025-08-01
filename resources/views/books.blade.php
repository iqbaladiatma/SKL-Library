@extends('layouts.app')

@section('title', 'Koleksi Buku - eLibrary')

@section('content')
<div class="bg-gradient-to-b from-emerald-900 to-teal-900 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h2 class="text-4xl font-bold text-white mb-4 animate-fade-in-down">
                eLibrary - Koleksi Digital
            </h2>
            <p class="text-emerald-200 text-lg max-w-2xl mx-auto">
                Jelajahi ribuan buku digital dari berbagai genre dan penulis ternama
            </p>
        </div>

        <!-- Search and Filters -->
        <div class="mb-16 space-y-6" data-aos="fade-right">
            <!-- Search Form -->
            <form method="GET" action="{{ route('books.index') }}" class="flex items-center space-x-4 bg-white/10 backdrop-blur-lg rounded-full px-6 py-4 border border-emerald-300 max-w-2xl mx-auto">
                <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input
                    type="text"
                    name="search"
                    value="{{ old('search', $search) }}"
                    placeholder="Cari judul, penulis, atau deskripsi..."
                    class="flex-1 bg-transparent outline-none placeholder-emerald-300 text-white text-lg" />
                <button type="submit" class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-full px-8 py-3 hover:scale-105 transition-transform shadow-lg border border-emerald-500 shadow-emerald-500/30">
                    Cari
                </button>
            </form>

            <!-- Filters -->
            <div class="flex flex-wrap items-center justify-center gap-4">
                <!-- Category Filter -->
                @if($categories->count() > 0)
                <select name="category" onchange="this.form.submit()" class="bg-white/10 backdrop-blur-lg border border-emerald-300 rounded-full px-4 py-2 text-white focus:outline-none focus:border-emerald-400">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }} class="bg-gray-800">{{ $cat }}</option>
                    @endforeach
                </select>
                @endif

                <!-- Content Type Filter -->
                <div class="flex bg-white/10 backdrop-blur-lg border border-emerald-300 rounded-full overflow-hidden">
                    <a href="{{ route('books.index', array_merge(request()->query(), ['filter' => 'all'])) }}"
                        class="px-4 py-2 text-sm {{ $filter == 'all' ? 'bg-emerald-500 text-white' : 'text-emerald-300 hover:bg-white/10' }} transition-colors">
                        Semua
                    </a>
                    <a href="{{ route('books.index', array_merge(request()->query(), ['filter' => 'free'])) }}"
                        class="px-4 py-2 text-sm {{ $filter == 'free' ? 'bg-emerald-500 text-white' : 'text-emerald-300 hover:bg-white/10' }} transition-colors">
                        Gratis
                    </a>
                    <a href="{{ route('books.index', array_merge(request()->query(), ['filter' => 'premium'])) }}"
                        class="px-4 py-2 text-sm {{ $filter == 'premium' ? 'bg-emerald-500 text-white' : 'text-emerald-300 hover:bg-white/10' }} transition-colors">
                        Premium
                    </a>
                </div>

                <!-- Clear Filters -->
                @if($search || $category || $filter != 'all')
                <a href="{{ route('books.index') }}" class="bg-red-500/20 text-red-300 px-4 py-2 rounded-full border border-red-300 hover:bg-red-500/30 transition-colors text-sm">
                    Bersihkan Filter
                </a>
                @endif
            </div>
        </div>

        <!-- Results Summary -->
        @if($search || $category || $filter != 'all')
        <div class="mb-8 text-center">
            <p class="text-emerald-200">
                Menampilkan {{ $books->total() }} buku
                @if($search) untuk "{{ $search }}"@endif
                @if($category) dalam kategori "{{ $category }}"@endif
                @if($filter == 'free') (gratis)@endif
                @if($filter == 'premium') (premium)@endif
            </p>
        </div>
        @endif

        <!-- Books Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4" data-aos="zoom-in">
            @foreach ($books as $book)
            <div class="bg-white/5 rounded-xl p-4 border border-white/10 hover:border-emerald-400/30 transition-all duration-300 group h-full">
                <div class="flex flex-col h-full" data-aos="zoom-in">
                    <div class="relative overflow-hidden rounded-lg mb-3 aspect-[3/4]">
                        <img
                            src="{{ $book->cover_image_url}}"
                            alt="Book Cover"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">

                        <!-- Premium Badge -->
                        @if($book->is_premium)
                        <div class="absolute top-2 left-2">
                            <span class="bg-yellow-500 text-yellow-900 px-2 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                PREMIUM
                            </span>
                        </div>
                        @endif

                        <!-- Stock Badge -->
                        <div class="absolute bottom-2 right-2 bg-black/50 text-white px-2 py-1 rounded-full text-xs font-medium">
                            {{ $book->stock }}
                        </div>

                        <!-- Category Badge -->
                        @if($book->category)
                        <div class="absolute bottom-2 left-2">
                            <span class="bg-emerald-500/80 text-white px-2 py-1 rounded-full text-xs">
                                {{ $book->category }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <h3 class="text-sm font-bold text-white mb-1 truncate">{{ $book->title }}</h3>
                        <p class="text-emerald-300 text-xs font-medium mb-2">Oleh {{ $book->author }}</p>
                        <p class="text-emerald-200 text-xs mb-3 line-clamp-2">{{ $book->description }}</p>

                        <!-- Book Details -->
                        <div class="space-y-1 mb-3">
                            @if($book->published_year)
                            <p class="text-emerald-300 text-xs">Tahun: {{ $book->published_year }}</p>
                            @endif
                            @if($book->pages)
                            <p class="text-emerald-300 text-xs">Halaman: {{ $book->pages }}</p>
                            @endif
                            @if($book->is_premium)
                            <p class="text-yellow-300 text-xs font-bold">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 mt-auto">
                        @auth
                        @if($book->is_premium)
                        <!-- Premium Book Actions -->
                        <a href="{{ route('books.show', $book->id) }}" class="w-full text-center bg-yellow-500/90 text-yellow-900 px-3 py-2 rounded-lg hover:bg-yellow-600 transition-colors flex items-center justify-center gap-1 text-xs font-bold">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                            </svg>
                            Beli
                        </a>
                        @else
                        <!-- Free Book Actions -->
                        <a href="{{ route('books.show', $book->id) }}" class="w-full text-center bg-emerald-500/90 text-white px-3 py-2 rounded-lg hover:bg-emerald-600 transition-colors flex items-center justify-center gap-1 text-xs font-bold">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Pinjam
                        </a>
                        @endif
                        @else
                        <a href="{{ route('login') }}" class="w-full text-center bg-gray-500/50 text-gray-300 px-3 py-2 rounded-lg hover:bg-gray-600/50 transition-colors text-xs">
                            Login untuk Akses
                        </a>
                        @endauth

                        <a href="{{ route('books.show', $book->id) }}" class="w-full text-center border border-emerald-500 text-emerald-300 px-3 py-2 rounded-lg hover:bg-emerald-500/10 transition-colors text-xs">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($books->count() == 0)
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-emerald-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <h3 class="text-xl font-semibold text-white mb-2">Tidak ada buku ditemukan</h3>
            <p class="text-emerald-200">Coba ubah filter atau kata kunci pencarian Anda</p>
        </div>
        @endif

        <!-- Pagination -->
        @if($books->hasPages())
        <div class="mt-12">
            {{ $books->appends(request()->query())->links() }}
        </div>
        @endif
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