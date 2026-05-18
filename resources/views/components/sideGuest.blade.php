<aside id="sidebar" class="fixed top-0 left-0 z-40 h-screen w-72 -translate-x-full transition-transform lg:translate-x-0">
    <div class="h-full overflow-y-auto bg-surface-900 px-6 py-8 text-white shadow-2xl">
        <!-- Brand -->
        <div class="mb-10 flex items-center space-x-3 px-2">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary-600 p-2 shadow-lg shadow-primary-600/20">
                <img src="{{ asset('images/logo-pancacita.png') }}" alt="Logo" class="h-full w-auto">
            </div>
            <div class="flex flex-col">
                <span class="font-display text-lg font-bold leading-tight tracking-tight text-white">Guest Portal</span>
                <span class="text-[10px] font-medium text-slate-400 uppercase tracking-[0.2em]">Diskominsa Aceh</span>
            </div>
        </div>

        <!-- User Profile Card -->
        <div class="mb-10 rounded-3xl bg-white/5 p-6 backdrop-blur-sm border border-white/5">
            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-primary-500/10 text-primary-400">
                <i data-lucide="user" class="h-8 w-8"></i>
            </div>
            <div class="space-y-1">
                <h3 class="font-display font-bold text-white">{{ $guest->nama_pelapor }}</h3>
                <p class="text-xs text-slate-400">NIP: {{ $guest->nip }}</p>
                <div class="mt-2 inline-block rounded-lg bg-primary-500/20 px-2 py-1 text-[10px] font-bold uppercase tracking-wider text-primary-400">
                    {{ $guest->instansi }}
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="space-y-2">
            <p class="mb-4 px-4 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500">Menu Utama</p>
            
            <a href="{{ route('guest.home') }}" class="group flex items-center space-x-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition-all {{ request()->routeIs('guest.home') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <i data-lucide="layout-grid" class="h-5 w-5 transition-transform group-hover:scale-110"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('guest.laporan.saya') }}" class="group flex items-center space-x-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition-all {{ request()->routeIs('guest.laporan.saya') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <i data-lucide="file-text" class="h-5 w-5 transition-transform group-hover:scale-110"></i>
                <span>Laporan Saya</span>
            </a>
            
            <a href="#" class="group flex items-center space-x-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition-all text-slate-400 hover:bg-white/5 hover:text-white">
                <i data-lucide="settings" class="h-5 w-5 transition-transform group-hover:scale-110"></i>
                <span>Pengaturan</span>
            </a>
        </nav>

        <!-- Footer Action -->
        <div class="absolute bottom-8 left-6 right-6">
            <form action="{{ route('guest.logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex w-full items-center justify-center space-x-2 rounded-2xl bg-red-500/10 py-4 text-sm font-bold text-red-500 transition-all hover:bg-red-500 hover:text-white">
                    <i data-lucide="log-out" class="h-5 w-5"></i>
                    <span>Keluar Sesi</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Sidebar Overlay (Mobile) -->
<div id="sidebar-overlay" class="fixed inset-0 z-30 hidden bg-slate-900/50 backdrop-blur-sm transition-opacity lg:hidden"></div>

<!-- Mobile Toggle (Only visible on mobile) -->
<div class="fixed top-0 left-0 right-0 z-30 flex items-center justify-between bg-white px-6 py-4 shadow-sm lg:hidden">
    <div class="flex items-center space-x-3">
        <img src="{{ asset('images/logo-pancacita.png') }}" alt="Logo" class="h-8 w-auto">
        <span class="font-display font-bold text-surface-900">Guest Portal</span>
    </div>
    <button id="sidebar-toggle" class="rounded-xl bg-surface-50 p-2 text-surface-600">
        <i data-lucide="menu" id="sidebar-icon" class="h-6 w-6"></i>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggle = document.getElementById('sidebar-toggle');
        const icon = document.getElementById('sidebar-icon');

        const toggleSidebar = () => {
            const isOpen = !sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                icon.setAttribute('data-lucide', 'menu');
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                icon.setAttribute('data-lucide', 'x');
            }
            lucide.createIcons();
        };

        toggle.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    });
</script>
