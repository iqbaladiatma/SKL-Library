@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row min-h-screen bg-gradient-to-br from-emerald-900 to-teal-900">
    <!-- Tombol Toggle Sidebar -->
    <button id="toggle-sidebar" class="block md:hidden bg-emerald-500 text-white p-3 rounded-xl m-4 hover:bg-emerald-600 transition-colors shadow-lg">
        ☰ Menu
    </button>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-white/5 backdrop-blur-lg border-r border-emerald-800 p-6 hidden md:block">
        <h1 class="text-2xl font-bold text-emerald-400 mb-8">eLibrary</h1>
        <ul class="space-y-3">
            <li>
                <a href="#dashboard" class="block py-3 px-4 text-emerald-200 hover:bg-emerald-500/20 rounded-xl transition-all bg-emerald-500/20">
                    📊 Dashboard
                </a>
            </li>
            <li>
                <a href="#borrowed" class="block py-3 px-4 text-emerald-200 hover:bg-emerald-500/20 rounded-xl transition-all">
                    📚 Buku Dipinjam
                </a>
            </li>
            <li>
                <a href="#profile" class="block py-3 px-4 text-emerald-200 hover:bg-emerald-500/20 rounded-xl transition-all">
                    👤 Profil
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <!-- Notifikasi -->
        @if (session('success'))
        <div class="bg-emerald-500/20 text-emerald-200 p-4 rounded-xl mb-6 border border-emerald-500/30">
            {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="bg-red-500/20 text-red-200 p-4 rounded-xl mb-6 border border-red-500/30">
            {{ session('error') }}
        </div>
        @endif

        <!-- Dashboard Overview -->
        <section id="dashboard">
            <h2 class="text-3xl font-bold mb-8 text-emerald-100">Dashboard</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-emerald-500/20 p-6 rounded-2xl border border-emerald-500/30 backdrop-blur-lg">
                    <h3 class="text-lg font-semibold text-emerald-200 mb-2">Buku Dipinjam</h3>
                    <p class="text-4xl font-bold text-emerald-400">{{ $totalBorrowed }}</p>
                </div>
                <div class="bg-teal-500/20 p-6 rounded-2xl border border-teal-500/30 backdrop-blur-lg">
                    <h3 class="text-lg font-semibold text-teal-200 mb-2">Terlambat</h3>
                    <p class="text-4xl font-bold text-teal-400">{{ $overdue }}</p>
                </div>
            </div>
        </section>

        <!-- Borrowed Books -->
        <section id="borrowed" class="hidden">
            <h2 class="text-3xl font-bold mb-8 text-emerald-100">Buku Dipinjam</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($borrowedBooks as $loan)
                <div class="bg-white/5 p-6 rounded-2xl border border-emerald-800 hover:border-emerald-500 transition-all backdrop-blur-lg">
                    <div class="space-y-3">
                        <h3 class="text-xl font-semibold text-emerald-100">{{ $loan->book->title }}</h3>
                        <p class="text-emerald-300">Penulis: {{ $loan->book->author }}</p>
                        <p class="text-emerald-300">Pinjam: {{ \Carbon\Carbon::parse($loan->pinjam_at)->format('d-m-Y') }}</p>

                        <div class="mt-4 space-y-3">
                            <!-- Kembalikan Sekarang -->
                            <form action="{{ route('dashboard.return', $loan->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="balik_at" value="{{ now()->format('Y-m-d') }}">
                                <button type="submit" 
                                        class="w-full bg-red-500/90 text-white px-6 py-3 rounded-xl hover:bg-red-600 transition-colors">
                                    Kembalikan Sekarang
                                </button>
                            </form>

                            <!-- Perpanjang -->
                            <form action="{{ route('dashboard.extend', $loan->id) }}" method="POST" class="flex flex-col gap-3">
                                @csrf
                                <input type="date" name="balik_at" 
                                       class="bg-white/5 border border-emerald-800 rounded-xl p-3 text-emerald-200 focus:ring-2 focus:ring-emerald-400">
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all">
                                    Perpanjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Profile -->
        <section id="profile" class="hidden">
            <h2 class="text-3xl font-bold mb-8 text-emerald-100">Profil</h2>
            <div class="bg-white/5 p-6 rounded-2xl border border-emerald-800 backdrop-blur-lg">
                <p class="text-emerald-300 mb-3"><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                <p class="text-emerald-300 mb-6"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <a href="{{ route('profile.edit') }}">
                    <button class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all">
                        Edit Profil
                    </button>
                </a>
            </div>
        </section>
    </main>
</div>

<script>
    // JavaScript untuk navigasi
    document.querySelectorAll('aside a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            document.querySelectorAll('main section').forEach(section => {
                section.classList.add('hidden');
            });
            document.getElementById(targetId).classList.remove('hidden');
            
            // Update active state
            document.querySelectorAll('aside a').forEach(l => {
                l.classList.remove('bg-emerald-500/20', 'text-emerald-400');
            });
            this.classList.add('bg-emerald-500/20', 'text-emerald-400');

            // Tutup sidebar di mobile
            if (window.innerWidth < 768) {
                document.getElementById('sidebar').classList.add('hidden');
            }
        });
    });

    // Toggle sidebar mobile
    document.getElementById('toggle-sidebar').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
        sidebar.classList.add('backdrop-blur-lg', 'border-emerald-800');
    });
</script>
@endsection