@extends('layouts.main')

@section('title', 'Login Layanan | Diskominsa Aceh')

@section('content')
<section class="relative flex min-h-screen items-center justify-center overflow-hidden bg-surface-50 pt-20 pb-12 px-4 sm:px-6">
    <!-- Background Accents -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-1/4 -left-20 w-64 h-64 md:w-96 md:h-96 bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute bottom-1/4 -right-20 w-64 h-64 md:w-96 md:h-96 bg-accent-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    </div>

    <div class="relative z-10 w-full max-w-md login-card opacity-0">
        <div class="glass overflow-hidden rounded-[2rem] sm:rounded-[2.5rem] p-6 sm:p-8 md:p-12 shadow-2xl">
            <!-- Logo & Header -->
            <div class="mb-8 md:mb-10 text-center">
                <div class="mx-auto mb-6 flex h-14 w-14 sm:h-16 sm:w-16 items-center justify-center rounded-2xl bg-primary-600 p-3 shadow-lg shadow-primary-600/20">
                    <i data-lucide="shield-check" class="h-full w-full text-white"></i>
                </div>
                <h2 class="font-display text-2xl sm:text-3xl font-bold tracking-tight text-surface-900">Selamat Datang</h2>
                <p class="mt-2 text-sm sm:text-base text-surface-500">Silakan masuk untuk mengakses layanan TIK</p>
            </div>

            <!-- Alerts -->
            @if(session('error'))
                <div class="mb-6 flex items-center space-x-3 rounded-2xl bg-red-50 p-4 text-sm text-red-600 border border-red-100">
                    <i data-lucide="alert-circle" class="h-5 w-5 shrink-0"></i>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 flex items-center space-x-3 rounded-2xl bg-accent-50 p-4 text-sm text-accent-600 border border-accent-100">
                    <i data-lucide="check-circle" class="h-5 w-5 shrink-0"></i>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('guest.login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="nik" class="mb-2 block text-sm font-bold text-surface-700">NIK (Nomor Induk Kependudukan)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                            <i data-lucide="id-card" class="h-5 w-5"></i>
                        </div>
                        <input 
                            type="text" 
                            id="nik" 
                            name="nik" 
                            value="{{ old('nik') }}"
                            class="block w-full rounded-2xl border border-surface-200 bg-white py-3 sm:py-4 pl-12 pr-4 text-surface-900 placeholder-surface-400 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10 text-sm sm:text-base" 
                            placeholder="Masukkan 16 digit NIK" 
                            required 
                            autofocus
                            autocomplete="username"
                        >
                    </div>
                    @error('nik')
                        <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="mb-2 flex items-center justify-between">
                        <label for="password" class="text-sm font-bold text-surface-700">Password</label>
                        <a href="#" class="text-xs font-semibold text-primary-600 hover:underline">Lupa Password?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                            <i data-lucide="lock" class="h-5 w-5"></i>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="block w-full rounded-2xl border border-surface-200 bg-white py-3 sm:py-4 pl-12 pr-12 text-surface-900 placeholder-surface-400 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10 text-sm sm:text-base" 
                            placeholder="••••••••" 
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-4 text-surface-400 hover:text-surface-600">
                            <i data-lucide="eye" id="eye-icon" class="h-5 w-5"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-xs font-medium text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="flex w-full items-center justify-center space-x-2 rounded-2xl bg-primary-600 py-3 sm:py-4 text-base sm:text-lg font-bold text-white shadow-xl shadow-primary-600/20 transition-all hover:bg-primary-700 active:scale-[0.98]">
                        <span>Masuk ke Akun</span>
                        <i data-lucide="log-in" class="h-5 w-5"></i>
                    </button>
                </div>
            </form>

            <!-- Footer Links -->
            <div class="mt-8 sm:mt-10 text-center">
                <p class="text-xs sm:text-sm text-surface-500">
                    Belum memiliki akun? 
                    <a href="{{ route('guest.register') }}" class="font-bold text-primary-600 hover:underline">Daftar Sekarang</a>
                </p>
                <div class="mt-4 sm:mt-6 flex items-center justify-center space-x-4">
                    <a href="{{ route('landing') }}" class="flex items-center space-x-1 text-[10px] sm:text-xs font-semibold text-surface-400 hover:text-surface-600">
                        <i data-lucide="arrow-left" class="h-3 w-3"></i>
                        <span>Beranda</span>
                    </a>
                    <span class="h-1 w-1 rounded-full bg-surface-300"></span>
                    <a href="#" class="text-[10px] sm:text-xs font-semibold text-surface-400 hover:text-surface-600">Bantuan</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Animation (Faster)
        anime({
            targets: '.login-card',
            translateY: [20, 0],
            opacity: [0, 1],
            duration: 600,
            easing: 'easeOutQuart'
        });

        // Password Toggle
        const passwordInput = document.getElementById('password');
        const toggleBtn = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eye-icon');

        toggleBtn.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            eyeIcon.setAttribute('data-lucide', isPassword ? 'eye-off' : 'eye');
            lucide.createIcons();
        });
    });
</script>
@endpush
