@extends('layouts.main')

@section('title', 'Form Lapor Masalah TIK | Diskominsa Aceh')

@section('content')
<div class="flex min-h-screen bg-surface-50">
    <!-- Sidebar -->
    @include('components.sideGuest', ['guest' => Auth::guard('guest')->user()])

    <!-- Main Content -->
    <div class="flex-1 lg:ml-72">
        <!-- Header -->
        <header class="sticky top-0 z-20 flex h-20 items-center justify-between border-b border-surface-200 bg-white/80 px-8 backdrop-blur-md">
            <div>
                <h1 class="font-display text-xl font-bold text-surface-900">Buat Laporan</h1>
                <p class="text-xs text-surface-500">Laporkan kendala teknis atau pengajuan layanan TIK</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('guest.laporan_saya') }}" class="inline-flex items-center space-x-2 rounded-xl bg-surface-100 px-4 py-2 text-sm font-bold text-surface-600 transition-all hover:bg-surface-200">
                    <i data-lucide="history" class="h-4 w-4"></i>
                    <span>Riwayat Laporan</span>
                </a>
            </div>
        </header>

        <main class="p-8">
            <div class="mx-auto max-w-4xl">
                <!-- Form Card -->
                <div class="overflow-hidden rounded-[2.5rem] bg-white shadow-xl shadow-surface-200/50 border border-surface-100 form-card opacity-0">
                    <div class="bg-primary-600 p-8 text-white">
                        <div class="flex items-center space-x-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 backdrop-blur-md">
                                <i data-lucide="clipboard-edit" class="h-6 w-6"></i>
                            </div>
                            <div>
                                <h2 class="font-display text-xl font-bold">Formulir Laporan</h2>
                                <p class="text-sm text-primary-100">Mohon lengkapi detail permasalahan Anda</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 md:p-12">
                        @if(session('success'))
                            <div class="mb-8 rounded-2xl bg-emerald-50 p-6 text-sm text-emerald-600 border border-emerald-100 flex items-center space-x-3">
                                <i data-lucide="check-circle" class="h-6 w-6"></i>
                                <div class="font-bold">{{ session('success') }}</div>
                                <script>setTimeout(() => window.location.href = "{{ route('landing') }}", 2000);</script>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="mb-8 rounded-2xl bg-red-50 p-6 text-sm text-red-600 border border-red-100">
                                <div class="flex items-center space-x-2 mb-2 font-bold">
                                    <i data-lucide="alert-circle" class="h-5 w-5"></i>
                                    <span>Terdapat kesalahan input:</span>
                                </div>
                                <ul class="list-disc list-inside opacity-90">
                                    @foreach($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('lapor.submit') }}" class="space-y-8">
                            @csrf

                            <!-- Profil Info (Read Only) -->
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-widest text-surface-400">Nama Pelapor</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400">
                                            <i data-lucide="user" class="h-5 w-5"></i>
                                        </div>
                                        <input type="text" value="{{ $guest->nama_pelapor }}" readonly class="block w-full rounded-2xl border border-surface-100 bg-surface-50 py-4 pl-12 pr-4 text-surface-500 outline-none">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-widest text-surface-400">Nomor WhatsApp</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400">
                                            <i data-lucide="phone" class="h-5 w-5"></i>
                                        </div>
                                        <input type="text" value="{{ $guest->no_hp }}" readonly class="block w-full rounded-2xl border border-surface-100 bg-surface-50 py-4 pl-12 pr-4 text-surface-500 outline-none">
                                    </div>
                                </div>
                                <div class="md:col-span-2 space-y-2">
                                    <label class="text-xs font-bold uppercase tracking-widest text-surface-400">Instansi</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400">
                                            <i data-lucide="building" class="h-5 w-5"></i>
                                        </div>
                                        <input type="text" value="{{ $guest->instansi }}" readonly class="block w-full rounded-2xl border border-surface-100 bg-surface-50 py-4 pl-12 pr-4 text-surface-500 outline-none">
                                    </div>
                                </div>
                            </div>

                            <hr class="border-surface-100">

                            <!-- Detail Laporan -->
                            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                                <div class="space-y-2">
                                    <label for="bidang" class="text-sm font-bold text-surface-700">Bidang / UPTD <span class="text-red-500">*</span></label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                                            <i data-lucide="briefcase" class="h-5 w-5"></i>
                                        </div>
                                        <input type="text" name="bidang" id="bidang" value="{{ old('bidang') }}" required class="block w-full rounded-2xl border border-surface-200 bg-white py-4 pl-12 pr-4 text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="Sebutkan bidang unit kerja">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label for="email_pelapor" class="text-sm font-bold text-surface-700">Email Pelapor</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                                            <i data-lucide="mail" class="h-5 w-5"></i>
                                        </div>
                                        <input type="email" name="email_pelapor" id="email_pelapor" value="{{ old('email_pelapor') }}" class="block w-full rounded-2xl border border-surface-200 bg-white py-4 pl-12 pr-4 text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="alamat@email.com">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label for="kategori_id" class="text-sm font-bold text-surface-700">Kategori Layanan <span class="text-red-500">*</span></label>
                                    <select name="kategori_id" id="kategori_id" required class="block w-full rounded-2xl border border-surface-200 bg-white py-4 px-4 text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10 appearance-none">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategori as $k)
                                            <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <label for="waktu_permasalahan" class="text-sm font-bold text-surface-700">Waktu Kejadian <span class="text-red-500">*</span></label>
                                    <div class="relative group">
                                        <input type="datetime-local" name="waktu_permasalahan" id="waktu_permasalahan" value="{{ old('waktu_permasalahan') }}" required class="block w-full rounded-2xl border border-surface-200 bg-white py-4 px-4 text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label for="ip_jaringan" class="text-sm font-bold text-surface-700">IP Jaringan</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                                            <i data-lucide="network" class="h-5 w-5"></i>
                                        </div>
                                        <input type="text" name="ip_jaringan" id="ip_jaringan" value="{{ old('ip_jaringan') }}" class="block w-full rounded-2xl border border-surface-200 bg-white py-4 pl-12 pr-4 text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="contoh: 192.168.1.x">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label for="ip_server" class="text-sm font-bold text-surface-700">IP Server</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                                            <i data-lucide="server" class="h-5 w-5"></i>
                                        </div>
                                        <input type="text" name="ip_server" id="ip_server" value="{{ old('ip_server') }}" class="block w-full rounded-2xl border border-surface-200 bg-white py-4 pl-12 pr-4 text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="contoh: 172.16.x.x">
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="laporan_permasalahan" class="text-sm font-bold text-surface-700">Deskripsi Permasalahan <span class="text-red-500">*</span></label>
                                <textarea name="laporan_permasalahan" id="laporan_permasalahan" rows="5" required class="block w-full rounded-2xl border border-surface-200 bg-white p-4 text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="Jelaskan secara detail kendala yang dialami...">{{ old('laporan_permasalahan') }}</textarea>
                            </div>

                            <div class="flex items-center justify-between pt-6">
                                <a href="{{ route('guest.home') }}" class="inline-flex items-center space-x-2 text-sm font-bold text-surface-400 hover:text-surface-600 transition-colors">
                                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                                    <span>Batal</span>
                                </a>
                                <button type="submit" class="flex items-center space-x-2 rounded-2xl bg-primary-600 px-8 py-4 text-lg font-bold text-white shadow-xl shadow-primary-600/20 transition-all hover:bg-primary-700 active:scale-[0.98]">
                                    <span>Kirim Laporan</span>
                                    <i data-lucide="send" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="px-8 py-6 text-center text-xs text-surface-400 border-t border-surface-200">
            <p>&copy; {{ date('Y') }} Diskominsa Aceh. All rights reserved.</p>
        </footer>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Form Card Animation
        anime({
            targets: '.form-card',
            translateY: [30, 0],
            opacity: [0, 1],
            duration: 1000,
            easing: 'easeOutQuart'
        });

        // Input Focus Stagger Animation (subtle)
        anime({
            targets: 'input, select, textarea',
            opacity: [0, 1],
            translateX: [-5, 0],
            delay: anime.stagger(50, {start: 500}),
            duration: 600,
            easing: 'easeOutQuart'
        });
    });
</script>
@endpush
