@extends('layouts.app')

@section('title', 'Hubungi Kami')
@section('content')
<div class="bg-gradient-to-b from-emerald-900 to-teal-900 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">Hubungi Kami</h1>
            <p class="text-emerald-200 text-lg max-w-2xl mx-auto">
                Punya pertanyaan atau masukan? Tim kami siap membantu Anda
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Contact Form -->
            <div class="bg-white/5 backdrop-blur-lg p-8 rounded-2xl border border-white/10">
                <form class="space-y-6">
                    <div>
                        <label class="block text-emerald-200 mb-2">Nama Lengkap</label>
                        <input 
                            type="text" 
                            class="w-full bg-white/5 border border-white/10 rounded-xl p-4 text-white focus:ring-2 focus:ring-emerald-400 transition"
                        >
                    </div>
                    
                    <div>
                        <label class="block text-emerald-200 mb-2">Email</label>
                        <input 
                            type="email" 
                            class="w-full bg-white/5 border border-white/10 rounded-xl p-4 text-white focus:ring-2 focus:ring-emerald-400 transition"
                        >
                    </div>
                    
                    <div>
                        <label class="block text-emerald-200 mb-2">Subjek</label>
                        <input 
                            type="text" 
                            class="w-full bg-white/5 border border-white/10 rounded-xl p-4 text-white focus:ring-2 focus:ring-emerald-400 transition"
                        >
                    </div>
                    
                    <div>
                        <label class="block text-emerald-200 mb-2">Pesan</label>
                        <textarea 
                            rows="5" 
                            class="w-full bg-white/5 border border-white/10 rounded-xl p-4 text-white focus:ring-2 focus:ring-emerald-400 transition"
                        ></textarea>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-emerald-500/90 text-white px-8 py-4 rounded-xl hover:bg-emerald-600 transition-colors"
                    >
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="space-y-6">
                <div class="bg-white/5 backdrop-blur-lg p-8 rounded-2xl border border-white/10">
                    <h3 class="text-xl font-bold text-white mb-6">Informasi Kontak</h3>
                    <div class="space-y-4 text-emerald-200">
                        <div class="flex items-start gap-4">
                            <svg class="w-6 h-6 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <p class="font-medium">Alamat Kantor</p>
                                <p>Jl. Literasi Digital No. 123<br>Jakarta Selatan, Indonesia</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <svg class="w-6 h-6 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div>
                                <p class="font-medium">Telepon</p>
                                <p>+62 21 1234 5678</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <svg class="w-6 h-6 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <p class="font-medium">Email</p>
                                <p>kontak@elibrary.id</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-lg p-8 rounded-2xl border border-white/10">
                    <h3 class="text-xl font-bold text-white mb-6">Jam Operasional</h3>
                    <div class="space-y-3 text-emerald-200">
                        <div class="flex justify-between">
                            <span>Senin - Jumat</span>
                            <span>08:00 - 20:00 WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Sabtu</span>
                            <span>09:00 - 17:00 WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Minggu/Hari Besar</span>
                            <span>Tutup</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection