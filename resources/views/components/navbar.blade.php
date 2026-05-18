<nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-4">
    <div class="container mx-auto px-6">
        <div class="glass flex items-center justify-between rounded-2xl px-6 py-3 shadow-lg transition-all duration-300">
            <!-- Brand -->
            <a href="{{ route('landing') }}" class="flex items-center space-x-3 group">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-600 p-2 shadow-lg shadow-primary-600/20 transition-transform group-hover:scale-110">
                    <img src="{{ asset('images/logo-pancacita.png') }}" alt="Logo" class="h-full w-auto">
                </div>
                <div class="flex flex-col">
                    <span class="font-display text-lg font-bold leading-tight tracking-tight text-surface-900">Diskominsa</span>
                    <span class="text-xs font-medium text-surface-500 uppercase tracking-wider">Aceh TIK</span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden items-center space-x-8 md:flex">
                <a href="#home" class="text-sm font-semibold text-surface-600 transition-colors hover:text-primary-600">Beranda</a>
                <a href="#about" class="text-sm font-semibold text-surface-600 transition-colors hover:text-primary-600">Tentang</a>
                <a href="#services" class="text-sm font-semibold text-surface-600 transition-colors hover:text-primary-600">Layanan</a>
                <a href="#contact" class="text-sm font-semibold text-surface-600 transition-colors hover:text-primary-600">Kontak</a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden items-center space-x-3 md:flex">
                @if(Auth::guard('guest')->check())
                    <a href="{{ route('guest.home') }}" class="flex items-center space-x-2 rounded-xl bg-primary-50 px-5 py-2.5 text-sm font-bold text-primary-600 transition-all hover:bg-primary-100">
                        <i data-lucide="layout-dashboard" class="h-4 w-4"></i>
                        <span>Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('guest.login') }}" class="flex items-center space-x-2 rounded-xl bg-primary-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-primary-600/20 transition-all hover:scale-105 hover:bg-primary-700 active:scale-95">
                        <i data-lucide="shield-check" class="h-4 w-4"></i>
                        <span>Akses Layanan</span>
                    </a>
                    <a href="{{ route('login') }}" class="flex items-center space-x-2 rounded-xl bg-white px-5 py-2.5 text-sm font-bold text-surface-700 border border-surface-200 transition-all hover:bg-surface-50">
                        <i data-lucide="log-in" class="h-4 w-4"></i>
                        <span>Login</span>
                    </a>
                @endif
            </div>

            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-toggle" class="rounded-xl p-2 text-surface-600 md:hidden hover:bg-surface-100 transition-colors">
                <i data-lucide="menu" id="menu-icon" class="h-6 w-6"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="absolute top-full left-6 right-6 mt-4 hidden origin-top scale-95 opacity-0 transition-all duration-300 md:hidden">
            <div class="glass flex flex-col space-y-4 rounded-2xl p-6 shadow-xl">
                <a href="#home" class="mobile-nav-link text-lg font-semibold text-surface-700">Beranda</a>
                <a href="#about" class="mobile-nav-link text-lg font-semibold text-surface-700">Tentang</a>
                <a href="#services" class="mobile-nav-link text-lg font-semibold text-surface-700">Layanan</a>
                <a href="#contact" class="mobile-nav-link text-lg font-semibold text-surface-700">Kontak</a>
                <div class="h-px bg-surface-200"></div>
                <div class="flex flex-col space-y-3 pt-2">
                    @if(Auth::guard('guest')->check())
                        <a href="{{ route('guest.home') }}" class="flex items-center justify-center space-x-2 rounded-xl bg-primary-600 py-3 font-bold text-white">
                            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                            <span>Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('guest.login') }}" class="flex items-center justify-center space-x-2 rounded-xl bg-primary-600 py-3 font-bold text-white">
                            <i data-lucide="shield-check" class="h-5 w-5"></i>
                            <span>Akses Layanan</span>
                        </a>
                        <a href="{{ route('login') }}" class="flex items-center justify-center space-x-2 rounded-xl border border-surface-200 bg-white py-3 font-bold text-surface-700">
                            <i data-lucide="log-in" class="h-5 w-5"></i>
                            <span>Login</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nav = document.getElementById('main-nav');
        const mobileToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');

        // Scroll Effect
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                nav.classList.add('py-2');
                nav.querySelector('.glass').classList.add('bg-white/90', 'shadow-xl');
            } else {
                nav.classList.remove('py-2');
                nav.querySelector('.glass').classList.remove('bg-white/90', 'shadow-xl');
            }
        });

        // Mobile Menu Toggle
        mobileToggle.addEventListener('click', () => {
            const isOpen = !mobileMenu.classList.contains('hidden');
            
            if (isOpen) {
                // Close
                mobileMenu.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
                menuIcon.setAttribute('data-lucide', 'menu');
            } else {
                // Open
                mobileMenu.classList.remove('hidden');
                setTimeout(() => {
                    mobileMenu.classList.remove('scale-95', 'opacity-0');
                    mobileMenu.classList.add('scale-100', 'opacity-100');
                }, 10);
                menuIcon.setAttribute('data-lucide', 'x');
            }
            lucide.createIcons();
        });

        // Close mobile menu on link click
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
                menuIcon.setAttribute('data-lucide', 'menu');
                lucide.createIcons();
            });
        });
    });
</script>
