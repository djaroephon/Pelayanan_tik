@extends('layouts.main')

@section('title', 'Portal Guest | Sistem Laporan TIK')

@section('content')
<div class="flex min-h-screen bg-surface-50">
    <!-- Sidebar -->
    @include('components.sideGuest', ['guest' => Auth::guard('guest')->user()])

    <!-- Main Content -->
    <div class="flex-1 lg:ml-72">
        <!-- Header -->
        <header class="sticky top-0 z-20 flex h-20 items-center justify-between border-b border-surface-200 bg-white/80 px-8 backdrop-blur-md">
            <div>
                <h1 class="font-display text-xl font-bold text-surface-900">Dashboard Tamu</h1>
                <p class="text-xs text-surface-500">Selamat datang kembali, {{ Auth::guard('guest')->user()->nama_pelapor }}</p>
            </div>
            <div class="flex items-center space-x-4">
                <button class="relative rounded-xl bg-surface-100 p-2 text-surface-600 transition-colors hover:bg-surface-200">
                    <i data-lucide="bell" class="h-5 w-5"></i>
                    <span class="absolute top-2 right-2 h-2 w-2 rounded-full bg-red-500"></span>
                </button>
                <div class="h-8 w-px bg-surface-200"></div>
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 overflow-hidden rounded-xl bg-primary-100 p-2 text-primary-600">
                        <i data-lucide="user" class="h-full w-full"></i>
                    </div>
                </div>
            </div>
        </header>

        <main class="p-4 sm:p-8">
            <!-- Alerts -->
            @if(session('success'))
                <div class="mb-8 flex items-center justify-between rounded-[2rem] bg-accent-50 p-6 text-accent-700 border border-accent-100 shadow-sm animate-fade-in">
                    <div class="flex items-center space-x-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-accent-500/20 text-accent-600">
                            <i data-lucide="check-circle" class="h-6 w-6"></i>
                        </div>
                        <div>
                            <p class="font-bold">Berhasil!</p>
                            <p class="text-sm opacity-90">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button class="rounded-xl p-2 hover:bg-accent-100 transition-colors">
                        <i data-lucide="x" class="h-5 w-5"></i>
                    </button>
                </div>
            @endif

            <!-- Welcome Hero -->
            <div class="relative mb-12 overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-primary-600 to-primary-800 p-8 sm:p-10 text-white shadow-xl welcome-card opacity-0">
                <div class="relative z-10 max-w-2xl">
                    <h2 class="font-display mb-4 text-3xl sm:text-4xl font-bold tracking-tight">Apa yang bisa kami bantu hari ini?</h2>
                    <p class="mb-8 text-base sm:text-lg text-primary-100 opacity-90">Laporkan kendala TIK Anda atau ajukan layanan pendukung lainnya dengan mudah dan pantau perkembangannya secara real-time.</p>
                    <a href="/lapor" class="inline-flex items-center space-x-2 rounded-2xl bg-white px-6 py-3 sm:px-8 sm:py-4 text-base sm:text-lg font-bold text-primary-600 shadow-lg transition-all hover:scale-105 active:scale-95">
                        <i data-lucide="plus-circle" class="h-5 w-5"></i>
                        <span>Buat Laporan Baru</span>
                    </a>
                </div>
                <!-- Abstract Decor -->
                <div class="absolute -right-20 -top-20 h-96 w-96 rounded-full bg-white/10 blur-3xl"></div>
                <div class="absolute -bottom-20 right-20 h-64 w-64 rounded-full bg-primary-400/20 blur-2xl"></div>
            </div>

            <!-- Stats Section -->
            <div class="mb-12 grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="stats-item opacity-0 group rounded-[2rem] bg-white p-6 sm:p-8 shadow-sm border border-surface-200 transition-all hover:shadow-md hover:border-primary-100">
                    <div class="mb-6 flex items-center justify-between">
                        <div class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <i data-lucide="check-square" class="h-6 w-6 sm:h-7 sm:w-7"></i>
                        </div>
                        <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-surface-400">Selesai</span>
                    </div>
                    <h3 class="font-display text-3xl sm:text-4xl font-bold text-surface-900 counter" data-target="{{ $stats['completed'] ?? 0 }}">0</h3>
                    <p class="mt-2 text-xs sm:text-sm font-medium text-surface-500">Laporan Telah Ditangani</p>
                </div>

                <div class="stats-item opacity-0 group rounded-[2rem] bg-white p-6 sm:p-8 shadow-sm border border-surface-200 transition-all hover:shadow-md hover:border-amber-100">
                    <div class="mb-6 flex items-center justify-between">
                        <div class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all">
                            <i data-lucide="clock" class="h-6 w-6 sm:h-7 sm:w-7"></i>
                        </div>
                        <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-surface-400">Proses</span>
                    </div>
                    <h3 class="font-display text-3xl sm:text-4xl font-bold text-surface-900 counter" data-target="{{ $stats['progress'] ?? 0 }}">0</h3>
                    <p class="mt-2 text-xs sm:text-sm font-medium text-surface-500">Dalam Penanganan Tim</p>
                </div>

                <div class="stats-item opacity-0 group rounded-[2rem] bg-white p-6 sm:p-8 shadow-sm border border-surface-200 transition-all hover:shadow-md hover:border-primary-100">
                    <div class="mb-6 flex items-center justify-between">
                        <div class="flex h-12 w-12 sm:h-14 sm:w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 group-hover:bg-primary-600 group-hover:text-white transition-all">
                            <i data-lucide="layers" class="h-6 w-6 sm:h-7 sm:w-7"></i>
                        </div>
                        <span class="text-[10px] sm:text-xs font-bold uppercase tracking-widest text-surface-400">Total</span>
                    </div>
                    <h3 class="font-display text-3xl sm:text-4xl font-bold text-surface-900 counter" data-target="{{ $stats['total'] ?? 0 }}">0</h3>
                    <p class="mt-2 text-xs sm:text-sm font-medium text-surface-500">Total Pengajuan Anda</p>
                </div>
            </div>

            <!-- Services Grid -->
            <div class="mb-8">
                <div class="mb-8 flex items-center justify-between">
                    <h2 class="font-display text-xl sm:text-2xl font-bold text-surface-900">Layanan Tersedia</h2>
                    <a href="#" class="text-xs sm:text-sm font-bold text-primary-600 hover:underline">Lihat Semua</a>
                </div>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Service Card -->
                    <div class="service-item opacity-0 group flex flex-col items-center rounded-[2rem] bg-white p-8 shadow-sm border border-surface-200 transition-all hover:shadow-lg hover:-translate-y-1">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 group-hover:bg-primary-600 group-hover:text-white transition-all">
                            <i data-lucide="plus-circle" class="h-8 w-8"></i>
                        </div>
                        <h4 class="font-display mb-2 text-center font-bold text-surface-900">Buat Laporan</h4>
                        <p class="text-center text-xs text-surface-500">Kendala Teknis TIK</p>
                        <a href="/lapor" class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-surface-50 py-3 text-xs font-bold text-surface-700 transition-all hover:bg-primary-50 hover:text-primary-600">
                            Pilih Layanan
                        </a>
                    </div>

                    <!-- Disabled Service -->
                    <div class="service-item opacity-0 group relative flex flex-col items-center rounded-[2rem] bg-surface-100/50 p-8 border border-dashed border-surface-300">
                        <div class="absolute top-4 right-4 rounded-full bg-amber-100 px-3 py-1 text-[10px] font-bold text-amber-600">Pending</div>
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-surface-200 text-surface-400">
                            <i data-lucide="move" class="h-8 w-8"></i>
                        </div>
                        <h4 class="font-display mb-2 text-center font-bold text-surface-400">Relokasi</h4>
                        <p class="text-center text-xs text-surface-400">Pindah Perangkat</p>
                        <button disabled class="mt-6 w-full rounded-xl bg-surface-200 py-3 text-xs font-bold text-surface-400 cursor-not-allowed">
                            Belum Tersedia
                        </button>
                    </div>

                    <!-- Add more placeholder services -->
                    @foreach(['VPN', 'Email', 'Colocation', 'Hosting'] as $item)
                    <div class="service-item opacity-0 group relative flex flex-col items-center rounded-[2rem] bg-surface-100/50 p-8 border border-dashed border-surface-300">
                        <div class="absolute top-4 right-4 rounded-full bg-surface-200 px-3 py-1 text-[10px] font-bold text-surface-500">Soon</div>
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-surface-200 text-surface-400">
                            <i data-lucide="lock" class="h-8 w-8"></i>
                        </div>
                        <h4 class="font-display mb-2 text-center font-bold text-surface-400">{{ $item }}</h4>
                        <p class="text-center text-xs text-surface-400">Layanan Terbatas</p>
                        <button disabled class="mt-6 w-full rounded-xl bg-surface-200 py-3 text-xs font-bold text-surface-400 cursor-not-allowed">
                            Belum Tersedia
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="px-8 py-6 text-center text-xs text-surface-400 border-t border-surface-200">
            <p>&copy; {{ date('Y') }} Diskominsa Aceh. Sistem Informasi Pelayanan TIK v2.2.0</p>
        </footer>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Hero Card Animation (Faster)
        anime({
            targets: '.welcome-card',
            translateY: [20, 0],
            opacity: [0, 1],
            duration: 600,
            easing: 'easeOutQuart'
        });

        // Stats Items Animation (Faster)
        anime({
            targets: '.stats-item',
            translateY: [20, 0],
            opacity: [0, 1],
            delay: anime.stagger(50, {start: 200}),
            duration: 600,
            easing: 'easeOutQuart'
        });

        // Service Items Animation (Faster)
        anime({
            targets: '.service-item',
            scale: [0.95, 1],
            opacity: [0, 1],
            delay: anime.stagger(30, {start: 400}),
            duration: 600,
            easing: 'easeOutQuart'
        });

        // Counter Animation (Faster)
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            anime({
                targets: { val: 0 },
                val: target,
                round: 1,
                easing: 'easeOutExpo',
                duration: 1200,
                delay: 200,
                update: (anim) => {
                    counter.innerHTML = anim.animatables[0].target.val;
                }
            });
        });
    });
</script>
@endpush
