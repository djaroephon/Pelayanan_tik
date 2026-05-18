<!-- Sidebar -->
<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0">
    <div class="flex h-full flex-col bg-surface-950 px-6 py-8 shadow-2xl shadow-black/50">
        <!-- Brand -->
        <div class="mb-10 px-2">
            <div class="flex items-center space-x-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-600 shadow-lg shadow-primary-600/20">
                    <i data-lucide="shield-check" class="h-7 w-7 text-white"></i>
                </div>
                <div>
                    <h2 class="font-display text-lg font-bold text-white leading-tight">Admin Panel</h2>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-primary-400">Pelayanan TIK</p>
                </div>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="mb-8 rounded-3xl bg-white/5 p-4 ring-1 ring-white/10">
            <div class="flex items-center space-x-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-surface-800 text-surface-400">
                    <i data-lucide="user" class="h-6 w-6"></i>
                </div>
                <div class="overflow-hidden">
                    <p class="truncate text-sm font-bold text-white">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-surface-500 uppercase tracking-tighter">Administrator</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 space-y-1 overflow-y-auto no-scrollbar">
            <p class="mb-4 px-2 text-[10px] font-bold uppercase tracking-[0.2em] text-surface-600">Menu Utama</p>

            <a href="{{ route('admin.dashboard') }}" class="group flex items-center space-x-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : 'text-surface-400 hover:bg-white/5 hover:text-white' }}">
                <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                <span>Dashboard</span>
            </a>

            <!-- Layanan Dropdown -->
            <div class="space-y-1 pt-2">
                <button type="button" class="dropdown-trigger group flex w-full items-center justify-between rounded-2xl px-4 py-3.5 text-sm font-semibold text-surface-400 transition-all hover:bg-white/5 hover:text-white">
                    <div class="flex items-center space-x-3">
                        <i data-lucide="server" class="h-5 w-5"></i>
                        <span>Layanan TIK</span>
                    </div>
                    <i data-lucide="chevron-down" class="h-4 w-4 transition-transform duration-300"></i>
                </button>
                <div class="dropdown-content hidden space-y-1 pl-12 overflow-hidden transition-all duration-300">
                    <a href="{{ route('laporan.index') }}" class="block py-2 text-sm text-surface-500 hover:text-primary-400">Kelola Laporan</a>
                    <a href="{{ route('kategori.index') }}" class="block py-2 text-sm text-surface-500 hover:text-primary-400">Kategori Layanan</a>
                    <a href="{{ route('admin.relokasi.index') }}" class="block py-2 text-sm text-surface-500 hover:text-primary-400">Data Relokasi</a>
                </div>
            </div>

            <a href="{{ route('wilayah.index') }}" class="group flex items-center space-x-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition-all {{ request()->routeIs('wilayah.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : 'text-surface-400 hover:bg-white/5 hover:text-white' }}">
                <i data-lucide="map-pin" class="h-5 w-5"></i>
                <span>Wilayah</span>
            </a>

            <a href="{{ route('teknisiAdmin.index') }}" class="group flex items-center space-x-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition-all {{ request()->routeIs('teknisiAdmin.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : 'text-surface-400 hover:bg-white/5 hover:text-white' }}">
                <i data-lucide="wrench" class="h-5 w-5"></i>
                <span>Tim Teknisi</span>
            </a>

            <p class="mb-4 mt-8 px-2 text-[10px] font-bold uppercase tracking-[0.2em] text-surface-600">Manajemen Akun</p>

            <a href="{{ route('admin.users.index') }}" class="group flex items-center space-x-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition-all {{ request()->routeIs('admin.users.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : 'text-surface-400 hover:bg-white/5 hover:text-white' }}">
                <i data-lucide="users" class="h-5 w-5"></i>
                <span>Petugas Admin</span>
            </a>

            <a href="{{ route('admin.guests.index') }}" class="group flex items-center space-x-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition-all {{ request()->routeIs('admin.guests.*') ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/20' : 'text-surface-400 hover:bg-white/5 hover:text-white' }}">
                <i data-lucide="user-cog" class="h-5 w-5"></i>
                <span>Daftar Guest</span>
            </a>
        </nav>

        <!-- Footer / Logout -->
        <div class="mt-8 pt-8 border-t border-white/5">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="group flex items-center space-x-3 rounded-2xl px-4 py-3.5 text-sm font-bold text-red-400 transition-all hover:bg-red-500/10 hover:text-red-300">
                <i data-lucide="log-out" class="h-5 w-5"></i>
                <span>Keluar Panel</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </div>
    </div>
</aside>

<!-- Mobile Overlay & Toggle -->
<div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-surface-950/50 backdrop-blur-sm lg:hidden"></div>
<button id="sidebar-toggle" class="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-primary-600 text-white shadow-2xl shadow-primary-600/40 lg:hidden">
    <i data-lucide="menu" id="toggle-icon" class="h-6 w-6"></i>
</button>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const toggleIcon = document.getElementById('toggle-icon');
        let isOpen = false;

        const toggleSidebar = () => {
            isOpen = !isOpen;
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            toggleIcon.setAttribute('data-lucide', isOpen ? 'x' : 'menu');
            lucide.createIcons();
        };

        toggleBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // Dropdown Logic
        document.querySelectorAll('.dropdown-trigger').forEach(btn => {
            btn.addEventListener('click', () => {
                const content = btn.nextElementSibling;
                const icon = btn.querySelector('[data-lucide="chevron-down"]');
                const isHidden = content.classList.contains('hidden');
                
                content.classList.toggle('hidden');
                icon.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
            });
        });
    });
</script>
