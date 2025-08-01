@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row min-h-screen bg-gradient-to-br from-emerald-900 to-teal-900">
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
                <a href="#purchased" class="block py-3 px-4 text-emerald-200 hover:bg-emerald-500/20 rounded-xl transition-all">
                    💰 Buku Dibeli
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
        <!-- Notifications -->
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
            <h2 class="text-3xl font-bold mb-8 text-emerald-100">Dashboard eLibrary</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="bg-emerald-500/20 p-6 rounded-2xl border border-emerald-500/30 backdrop-blur-lg">
                    <h3 class="text-lg font-semibold text-emerald-200 mb-2">Buku Dipinjam</h3>
                    <p class="text-4xl font-bold text-emerald-400">{{ $totalBorrowed }}</p>
                </div>
                <div class="bg-teal-500/20 p-6 rounded-2xl border border-teal-500/30 backdrop-blur-lg">
                    <h3 class="text-lg font-semibold text-teal-200 mb-2">Terlambat</h3>
                    <p class="text-4xl font-bold text-teal-400">{{ $overdue }}</p>
                </div>
                <div class="bg-yellow-500/20 p-6 rounded-2xl border border-yellow-500/30 backdrop-blur-lg">
                    <h3 class="text-lg font-semibold text-yellow-200 mb-2">Buku Dibeli</h3>
                    <p class="text-4xl font-bold text-yellow-400">{{ $totalPurchased }}</p>
                </div>
                <div class="bg-blue-500/20 p-6 rounded-2xl border border-blue-500/30 backdrop-blur-lg">
                    <h3 class="text-lg font-semibold text-blue-200 mb-2">Saldo</h3>
                    <p class="text-4xl font-bold text-blue-400">Rp {{ number_format($user->balance, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- User Info Card -->
            <div class="bg-white/5 p-6 rounded-2xl border border-emerald-500/30 backdrop-blur-lg mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-semibold text-emerald-100 mb-2">{{ $user->name }}</h3>
                        <p class="text-emerald-300 mb-1">{{ $user->email }}</p>
                        <div class="flex items-center gap-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-500/20 text-emerald-300">
                                {{ ucfirst($user->subscription_type) }} Member
                            </span>
                            @if($user->subscription_expires_at)
                            <span class="text-emerald-300 text-sm">
                                Expires: {{ \Carbon\Carbon::parse($user->subscription_expires_at)->format('d M Y') }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-emerald-400">Rp {{ number_format($user->balance, 0, ',', '.') }}</p>
                        <p class="text-emerald-300 text-sm">Available Balance</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Borrowed Books -->
        <section id="borrowed" class="hidden">
            <h2 class="text-3xl font-bold mb-8 text-emerald-100">Buku Dipinjam</h2>
            @if($borrowedBooks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($borrowedBooks as $loan)
                <div class="bg-white/5 p-6 rounded-2xl border border-emerald-800 hover:border-emerald-500 transition-all backdrop-blur-lg">
                    <div class="space-y-3">
                        <div class="flex items-start justify-between">
                            <h3 class="text-xl font-semibold text-emerald-100">{{ $loan->book->title }}</h3>
                            @if($loan->book->is_premium)
                            <span class="bg-yellow-500 text-yellow-900 px-2 py-1 rounded-full text-xs font-bold">
                                PREMIUM
                            </span>
                            @endif
                        </div>
                        <p class="text-emerald-300">Penulis: {{ $loan->book->author }}</p>
                        <p class="text-emerald-300">Pinjam: {{ \Carbon\Carbon::parse($loan->pinjam_at)->format('d-m-Y') }}</p>
                        <p class="text-emerald-300">Kembali: {{ \Carbon\Carbon::parse($loan->balik_at)->format('d-m-Y') }}</p>

                        <div class="mt-4 space-y-3">
                            @if($loan->book->content)
                            <a href="{{ route('books.read', $loan->book->id) }}"
                                class="w-full bg-emerald-500/90 text-white px-6 py-3 rounded-xl hover:bg-emerald-600 transition-colors flex items-center justify-center gap-2">
                                Baca Online
                            </a>
                            @endif

                            <form action="{{ route('dashboard.return', $loan->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="balik_at" value="{{ now()->format('Y-m-d') }}">
                                <button type="submit"
                                    class="w-full bg-red-500/90 text-white px-6 py-3 rounded-xl hover:bg-red-600 transition-colors">
                                    Kembalikan Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <h3 class="text-xl font-semibold text-white mb-2">Tidak ada buku yang dipinjam</h3>
                <p class="text-emerald-200">Mulai jelajahi koleksi buku kami</p>
                <a href="{{ route('books.index') }}" class="inline-block mt-4 bg-emerald-500 text-white px-6 py-3 rounded-xl hover:bg-emerald-600 transition-colors">
                    Jelajahi Buku
                </a>
            </div>
            @endif
        </section>

        <!-- Purchased Books -->
        <section id="purchased" class="hidden">
            <h2 class="text-3xl font-bold mb-8 text-emerald-100">Buku Dibeli</h2>
            @if($purchasedBooks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($purchasedBooks as $purchase)
                <div class="bg-white/5 p-6 rounded-2xl border border-emerald-800 hover:border-emerald-500 transition-all backdrop-blur-lg">
                    <div class="space-y-3">
                        <div class="flex items-start justify-between">
                            <h3 class="text-xl font-semibold text-emerald-100">{{ $purchase->book->title }}</h3>
                            <span class="bg-green-500 text-green-900 px-2 py-1 rounded-full text-xs font-bold">
                                DIBELI
                            </span>
                        </div>
                        <p class="text-emerald-300">Penulis: {{ $purchase->book->author }}</p>
                        <p class="text-emerald-300">Dibeli: {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}</p>
                        <p class="text-emerald-300">Harga: Rp {{ number_format($purchase->amount_paid, 0, ',', '.') }}</p>

                        <div class="mt-4 space-y-3">
                            @if($purchase->book->content)
                            <a href="{{ route('books.read', $purchase->book->id) }}"
                                class="w-full bg-emerald-500/90 text-white px-6 py-3 rounded-xl hover:bg-emerald-600 transition-colors flex items-center justify-center gap-2">
                                Baca Online
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <h3 class="text-xl font-semibold text-white mb-2">Belum ada buku yang dibeli</h3>
                <p class="text-emerald-200">Jelajahi koleksi premium kami</p>
                <a href="{{ route('books.index', ['filter' => 'premium']) }}" class="inline-block mt-4 bg-yellow-500 text-yellow-900 px-6 py-3 rounded-xl hover:bg-yellow-600 transition-colors font-bold">
                    Lihat Buku Premium
                </a>
            </div>
            @endif
        </section>

        <!-- Profile Section -->
        <section id="profile" class="hidden">
            <h2 class="text-3xl font-bold mb-8 text-emerald-100">Profil</h2>
            <div class="bg-white/5 p-8 rounded-2xl border border-emerald-500/30 backdrop-blur-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold text-emerald-100 mb-4">Informasi Pribadi</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="text-emerald-300 text-sm">Nama</label>
                                <p class="text-white font-medium">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="text-emerald-300 text-sm">Email</label>
                                <p class="text-white font-medium">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="text-emerald-300 text-sm">Bergabung Sejak</label>
                                <p class="text-white font-medium">{{ \Carbon\Carbon::parse($user->created_at)->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-emerald-100 mb-4">Informasi eLibrary</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="text-emerald-300 text-sm">Tipe Langganan</label>
                                <p class="text-white font-medium">{{ ucfirst($user->subscription_type) }}</p>
                            </div>
                            <div>
                                <label class="text-emerald-300 text-sm">Saldo</label>
                                <p class="text-white font-medium">Rp {{ number_format($user->balance, 0, ',', '.') }}</p>
                            </div>
                            @if($user->subscription_expires_at)
                            <div>
                                <label class="text-emerald-300 text-sm">Berlaku Sampai</label>
                                <p class="text-white font-medium">{{ \Carbon\Carbon::parse($user->subscription_expires_at)->format('d F Y') }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-emerald-500/30">
                    <a href="{{ route('profile.edit') }}" class="bg-emerald-500 text-white px-6 py-3 rounded-xl hover:bg-emerald-600 transition-colors">
                        Edit Profil
                    </a>
                </div>
            </div>
        </section>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('#sidebar a');
        const sections = document.querySelectorAll('main > section');

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                navLinks.forEach(l => l.classList.remove('bg-emerald-500/20'));
                this.classList.add('bg-emerald-500/20');

                sections.forEach(section => section.classList.add('hidden'));

                const targetId = this.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.classList.remove('hidden');
                }
            });
        });
    });
</script>
@endsection