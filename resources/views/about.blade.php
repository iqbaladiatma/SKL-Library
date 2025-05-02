@extends('layouts.app')

@section('title', 'Tentang eLibrary')
@section('content')
<div class="bg-gradient-to-b from-emerald-900 to-teal-900 min-h-screen py-12" data-aos="zoom-in">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4 animate-fade-in-down">
                Tentang eLibrary
            </h1>
            <p class="text-emerald-200 text-lg max-w-2xl mx-auto">
                Membuka akses pengetahuan melalui platform digital yang inovatif
            </p>
        </div>

        <!-- Mission & Team -->
        <div class="grid md:grid-cols-2 gap-12 mb-20" data-aos="fade-up" data-aos-duration="3000">
            <div class="relative overflow-hidden rounded-2xl aspect-video">
                <img 
                    src="https://via.placeholder.com/800x500?text=Perpustakaan+Digital" 
                    alt="Perpustakaan" 
                    class="w-full h-full object-cover"
                >
            </div>
            
            <div class="space-y-8">
                <div class="bg-white/5 p-8 rounded-2xl backdrop-blur-lg border border-white/10" data-aos="flip-left">
                    <h2 class="text-3xl font-bold text-white mb-4">Misi Kami</h2>
                    <p class="text-emerald-200 leading-relaxed">
                        eLibrary hadir untuk merombak cara tradisional dalam mengakses pengetahuan, memberikan kemudahan 
                        dalam menjelajahi, meminjam, dan mengelola koleksi buku digital secara modern.
                    </p>
                </div>
                
                <div class="bg-white/5 p-8 rounded-2xl backdrop-blur-lg border border-white/10">
                    <h2 class="text-3xl font-bold text-white mb-4">Tim Kami</h2>
                    <p class="text-emerald-200 leading-relaxed">
                        Kolaborasi antara ahli literasi, pengembang teknologi, dan desainer kreatif yang berdedikasi 
                        menciptakan pengalaman membaca terbaik untuk Anda.
                    </p>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-white/10 mb-20" data-aos="zoom-in-up">
            <h2 class="text-3xl font-bold text-white mb-12 text-center">Keunggulan eLibrary</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="feature-card p-6 rounded-xl border border-white/10 hover:border-emerald-400/30 transition-all">
                    <div class="w-12 h-12 mb-4 bg-emerald-500/20 rounded-lg flex items-center justify-center text-emerald-400">
                        🔍
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Pencarian Cerdas</h3>
                    <p class="text-emerald-200 text-sm">Temukan buku dengan cepat menggunakan filter canggih</p>
                </div>
                
                <div class="feature-card p-6 rounded-xl border border-white/10 hover:border-emerald-400/30 transition-all">
                    <div class="w-12 h-12 mb-4 bg-emerald-500/20 rounded-lg flex items-center justify-center text-emerald-400">
                        📚
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Koleksi Lengkap</h3>
                    <p class="text-emerald-200 text-sm">Ribuan buku digital dari berbagai genre terpopuler</p>
                </div>
                
                <div class="feature-card p-6 rounded-xl border border-white/10 hover:border-emerald-400/30 transition-all">
                    <div class="w-12 h-12 mb-4 bg-emerald-500/20 rounded-lg flex items-center justify-center text-emerald-400">
                        ⏱️
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Akses 24/7</h3>
                    <p class="text-emerald-200 text-sm">Baca kapan saja melalui berbagai perangkat</p>
                </div>
                
                <div class="feature-card p-6 rounded-xl border border-white/10 hover:border-emerald-400/30 transition-all">
                    <div class="w-12 h-12 mb-4 bg-emerald-500/20 rounded-lg flex items-center justify-center text-emerald-400">
                        🔒
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">Keamanan Data</h3>
                    <p class="text-emerald-200 text-sm">Proteksi maksimal untuk privasi pembaca</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection