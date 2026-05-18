@extends('layouts.main')

@section('title', 'Admin Login | Diskominsa Aceh')

@section('content')
<section class="relative flex min-h-screen items-center justify-center overflow-hidden bg-surface-50 px-4 sm:px-6">
    <!-- Background Accents -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-1/4 -left-20 w-64 h-64 md:w-[30rem] md:h-[30rem] bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute bottom-1/4 -right-20 w-64 h-64 md:w-[30rem] md:h-[30rem] bg-accent-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    </div>

    <div class="relative z-10 w-full max-w-md login-card opacity-0">
        <div class="glass overflow-hidden rounded-[2rem] sm:rounded-[2.5rem] p-6 sm:p-8 md:p-12 shadow-2xl">
            <!-- Header -->
            <div class="mb-8 md:mb-10 text-center">
                <div class="mx-auto mb-6 flex h-14 w-14 sm:h-16 sm:w-16 items-center justify-center rounded-2xl bg-primary-600 p-3 shadow-lg shadow-primary-600/20">
                    <i data-lucide="shield-check" class="h-full w-full text-white"></i>
                </div>
                <h2 class="font-display text-2xl sm:text-3xl font-bold tracking-tight text-surface-900">Admin Portal</h2>
                <p class="mt-2 text-sm sm:text-base text-surface-500">Silakan masuk untuk mengelola layanan</p>
            </div>

            <!-- Alerts -->
            @if(session('error'))
                <div class="mb-6 rounded-2xl bg-red-50 p-4 text-sm text-red-600 border border-red-100 flex items-center space-x-3">
                    <i data-lucide="alert-circle" class="h-5 w-5 shrink-0"></i>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-emerald-50 p-4 text-sm text-emerald-600 border border-emerald-100 flex items-center space-x-3">
                    <i data-lucide="check-circle" class="h-5 w-5 shrink-0"></i>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="name" class="text-sm font-bold text-surface-700">Username</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                            <i data-lucide="user" class="h-5 w-5"></i>
                        </div>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="username" class="block w-full rounded-2xl border border-surface-200 bg-white py-3 sm:py-4 pl-12 pr-4 text-sm sm:text-base text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="Username admin">
                    </div>
                    @error('name')
                        <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label for="password" class="text-sm font-bold text-surface-700">Password</label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                            <i data-lucide="lock" class="h-5 w-5"></i>
                        </div>
                        <input type="password" id="password" name="password" required autocomplete="current-password" class="block w-full rounded-2xl border border-surface-200 bg-white py-3 sm:py-4 pl-12 pr-12 text-sm sm:text-base text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-4 text-surface-400 hover:text-surface-600 transition-colors">
                            <i data-lucide="eye" class="h-5 w-5"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="group relative flex w-full items-center justify-center space-x-2 rounded-2xl bg-primary-600 py-3 sm:py-4 text-base sm:text-lg font-bold text-white shadow-xl shadow-primary-600/20 transition-all hover:bg-primary-700 active:scale-[0.98]">
                    <span>Masuk ke Sistem</span>
                    <i data-lucide="arrow-right" class="h-5 w-5 transition-transform group-hover:translate-x-1"></i>
                </button>
            </form>

            <!-- Bottom Links -->
            <div class="mt-8 sm:mt-10 border-t border-surface-100 pt-6 sm:pt-8 text-center">
                <a href="{{ route('landing') }}" class="inline-flex items-center space-x-2 text-xs sm:text-sm font-semibold text-surface-400 hover:text-primary-600 transition-colors">
                    <i data-lucide="home" class="h-4 w-4"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Entrance Animation (Faster)
        anime({
            targets: '.login-card',
            translateY: [20, 0],
            opacity: [0, 1],
            duration: 600,
            easing: 'easeOutQuart'
        });

        // Password Toggle
        const toggleBtn = document.getElementById('togglePassword');
        const passInput = document.getElementById('password');
        
        toggleBtn.addEventListener('click', () => {
            const isPass = passInput.type === 'password';
            passInput.type = isPass ? 'text' : 'password';
            toggleBtn.innerHTML = `<i data-lucide="${isPass ? 'eye-off' : 'eye'}" class="h-5 w-5"></i>`;
            lucide.createIcons();
        });
    });
</script>
@endpush
