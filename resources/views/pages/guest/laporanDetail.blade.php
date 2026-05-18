@extends('layouts.main')

@section('title', 'Laporan Saya | Portal Guest')

@section('content')
<div class="flex min-h-screen bg-surface-50">
    <!-- Sidebar -->
    @include('components.sideGuest', ['guest' => Auth::guard('guest')->user()])

    <!-- Main Content -->
    <div class="flex-1 lg:ml-72">
        <!-- Header -->
        <header class="sticky top-0 z-20 flex h-20 items-center justify-between border-b border-surface-200 bg-white/80 px-8 backdrop-blur-md">
            <div>
                <h1 class="font-display text-xl font-bold text-surface-900">Riwayat Laporan</h1>
                <p class="text-xs text-surface-500">Pantau perkembangan pengajuan layanan Anda</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/lapor" class="inline-flex items-center space-x-2 rounded-xl bg-primary-600 px-4 py-2 text-sm font-bold text-white shadow-lg shadow-primary-600/20 transition-all hover:bg-primary-700">
                    <i data-lucide="plus-circle" class="h-4 w-4"></i>
                    <span>Buat Laporan</span>
                </a>
            </div>
        </header>

        <main class="p-4 sm:p-8">
            <!-- Table Card -->
            <div class="overflow-hidden rounded-[2rem] bg-white shadow-sm border border-surface-200 table-card opacity-0">
                <div class="border-b border-surface-100 bg-surface-50/50 px-6 sm:px-8 py-6">
                    <h2 class="font-display text-lg font-bold text-surface-900 flex items-center space-x-2">
                        <i data-lucide="list" class="h-5 w-5 text-primary-600"></i>
                        <span>Daftar Pengajuan</span>
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left min-w-[800px]">
                        <thead>
                            <tr class="border-b border-surface-100 bg-surface-50/30">
                                <th class="px-6 sm:px-8 py-4 text-[10px] font-bold uppercase tracking-widest text-surface-400">ID</th>
                                <th class="px-6 sm:px-8 py-4 text-[10px] font-bold uppercase tracking-widest text-surface-400">Layanan</th>
                                <th class="px-6 sm:px-8 py-4 text-[10px] font-bold uppercase tracking-widest text-surface-400">Permasalahan</th>
                                <th class="px-6 sm:px-8 py-4 text-[10px] font-bold uppercase tracking-widest text-surface-400">Tanggal</th>
                                <th class="px-6 sm:px-8 py-4 text-[10px] font-bold uppercase tracking-widest text-surface-400 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-100">
                            @forelse($laporan as $item)
                                <tr class="group hover:bg-surface-50 transition-colors">
                                    <td class="px-6 sm:px-8 py-6 text-sm font-bold text-surface-900">#{{ $item->id }}</td>
                                    <td class="px-6 sm:px-8 py-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-50 text-primary-600">
                                                <i data-lucide="layers" class="h-4 w-4"></i>
                                            </div>
                                            <span class="text-sm font-semibold text-surface-700">{{ $item->kategori->nama_kategori }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 sm:px-8 py-6">
                                        <p class="max-w-xs truncate text-sm text-surface-600 group-hover:text-surface-900 transition-colors" title="{{ $item->laporan_permasalahan }}">
                                            {{ $item->laporan_permasalahan }}
                                        </p>
                                    </td>
                                    <td class="px-6 sm:px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-medium text-surface-700">{{ $item->created_at->format('d M Y') }}</span>
                                            <span class="text-[10px] text-surface-400">{{ $item->created_at->format('H:i') }} WIB</span>
                                        </div>
                                    </td>
                                    <td class="px-6 sm:px-8 py-6 text-center">
                                        @if ($item->status === 'complete')
                                            <span class="inline-flex items-center space-x-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-600 border border-emerald-100">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
                                                <span>Selesai</span>
                                            </span>
                                        @elseif ($item->status === 'process')
                                            <span class="inline-flex items-center space-x-1.5 rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-600 border border-amber-100">
                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                                                <span>Diproses</span>
                                            </span>
                                        @elseif ($item->status === 'pending')
                                            <span class="inline-flex items-center space-x-1.5 rounded-full bg-surface-100 px-3 py-1 text-xs font-bold text-surface-500 border border-surface-200">
                                                <span class="h-1.5 w-1.5 rounded-full bg-surface-500"></span>
                                                <span>Menunggu</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center space-x-1.5 rounded-full bg-primary-50 px-3 py-1 text-xs font-bold text-primary-600 border border-primary-100">
                                                <i data-lucide="info" class="h-3 w-3"></i>
                                                <span>{{ ucfirst($item->status) }}</span>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 sm:px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-surface-50 text-surface-200">
                                                <i data-lucide="inbox" class="h-10 w-10"></i>
                                            </div>
                                            <h3 class="font-display text-lg font-bold text-surface-900">Belum Ada Laporan</h3>
                                            <p class="mt-1 text-sm text-surface-500">Anda belum pernah mengajukan laporan layanan TIK.</p>
                                            <a href="/lapor" class="mt-6 font-bold text-primary-600 hover:underline">Buat Laporan Pertama</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
        // Table Card Animation (Faster)
        anime({
            targets: '.table-card',
            translateY: [20, 0],
            opacity: [0, 1],
            duration: 600,
            easing: 'easeOutQuart'
        });

        // Rows Stagger Animation
        anime({
            targets: 'tbody tr',
            translateX: [-10, 0],
            opacity: [0, 1],
            delay: anime.stagger(30, {start: 200}),
            duration: 600,
            easing: 'easeOutQuart'
        });
    });
</script>
@endpush
