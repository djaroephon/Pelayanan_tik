<style>
    :root {
        --sidebar-bg: #212529;
        --sidebar-hover: #343a40;
        --sidebar-active: #4361ee;
        --sidebar-text: #ced4da;
        --sidebar-width: 280px;
        --sidebar-transition: all 0.3s ease;
        --dropdown-bg: #1a1e21;
        --dropdown-hover: #2d3238;
    }

    /* Sidebar Styling */
    .sidebar {
        min-height: 100vh;
        background: linear-gradient(to bottom, var(--sidebar-bg), #1a1e21);
        width: var(--sidebar-width);
        position: fixed;
        top: 0;
        left: 0;
        padding: 1.5rem 1rem;
        color: white;
        z-index: 1000;
        box-shadow: 3px 0 15px rgba(0, 0, 0, 0.2);
        overflow-y: auto;
        transition: var(--sidebar-transition);
    }

    /* Custom Scrollbar for Sidebar */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background-color: #495057;
        border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background-color: #6c757d;
    }

    .sidebar-header {
        padding: 0 0 1.5rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 1.5rem;
    }

    .sidebar h4 {
        font-weight: 700;
        margin: 0;
        font-size: 1.4rem;
        letter-spacing: 1px;
        text-align: center;
        background: linear-gradient(to right, #4cc9f0, #4361ee);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        padding: 0.5rem 0;
    }

    .sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-nav li {
        margin-bottom: 0.4rem;
        position: relative;
    }

    .sidebar-nav a {
        color: var(--sidebar-text);
        display: flex;
        align-items: center;
        padding: 0.8rem 1.2rem;
        text-decoration: none;
        border-radius: 8px;
        transition: var(--sidebar-transition);
        position: relative;
        font-weight: 500;
    }

    .sidebar-nav > li > a:hover {
        background-color: var(--sidebar-hover);
        color: #ffffff;
        transform: translateX(5px);
    }

    .sidebar-nav > li > a:hover::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: linear-gradient(to bottom, #4361ee, #4cc9f0);
        border-radius: 4px 0 0 4px;
    }

    .sidebar-nav a.active {
        background: linear-gradient(to right, #4361ee, #3a56d4);
        color: white;
        box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
    }

    .sidebar-nav a i {
        width: 24px;
        margin-right: 12px;
        font-size: 1.1rem;
        transition: var(--sidebar-transition);
    }

    .sidebar-nav a.active i,
    .sidebar-nav a:hover i {
        transform: scale(1.1);
    }

    /* Dropdown Styling */
    .dropdown-toggle {
        position: relative;
        cursor: pointer;
    }

    .dropdown-toggle::after {
        content: '\f107';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        border: none;
        margin-left: auto;
        transition: var(--sidebar-transition);
    }

    .dropdown-toggle.show::after {
        transform: rotate(180deg);
    }

    .dropdown-menu {
        background-color: var(--dropdown-bg);
        border: none;
        border-radius: 8px;
        padding: 0.5rem 0;
        margin-top: 0.5rem;
        margin-left: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        display: none;
        position: static;
        float: none;
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-item {
        color: var(--sidebar-text);
        padding: 0.7rem 1.5rem;
        font-weight: 500;
        transition: var(--sidebar-transition);
        border-left: 3px solid transparent;
        display: flex;
        align-items: center;
        background: transparent;
        width: 100%;
        border: none;
        text-align: left;
    }

    .dropdown-item:hover {
        background-color: var(--dropdown-hover);
        color: white;
        border-left-color: #4361ee;
        transform: translateX(5px);
    }

    .dropdown-item i {
        width: 20px;
        margin-right: 10px;
        font-size: 1rem;
    }

    /* Nested Dropdown */
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        margin-left: 0.5rem;
        margin-top: 0;
    }

    .logout-section {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logout-link {
        display: flex;
        align-items: center;
        padding: 0.8rem 1.2rem;
        color: #f8d7da !important;
        background: linear-gradient(to right, #dc3545, #c82333);
        text-decoration: none;
        border-radius: 8px;
        transition: var(--sidebar-transition);
        font-weight: 500;
    }

    .logout-link:hover {
        background: linear-gradient(to right, #c82333, #a71e2a);
        color: #ffffff !important;
        transform: translateX(5px);
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
    }

    .logout-link i {
        width: 24px;
        margin-right: 12px;
        font-size: 1.1rem;
    }

    /* Responsive design */
    .sidebar-toggle {
        display: none;
    }

    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
            width: 250px;
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .sidebar-toggle {
            display: flex;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            background: var(--sidebar-active);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
    }
</style>

<!-- Sidebar Toggle Button (Mobile Only) -->
<button class="sidebar-toggle d-lg-none">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <h4><i class="fas fa-user-shield me-2"></i>{{ auth()->user()->name}} Panel</h4>
    </div>

    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="active">
                <i class="fas fa-tachometer-alt"></i>Dashboard
            </a>
        </li>

        <!-- Dropdown Layanan -->
        <li class="dropdown">
            <a class="dropdown-toggle" href="#">
                <i class="fas fa-concierge-bell"></i>Layanan
            </a>
            <ul class="dropdown-menu">
                <!-- Submenu Laporan -->
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">
                        <i class="fas fa-file-alt"></i>Laporan
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('kategori.index') }}">
                                <i class="fas fa-tags"></i>Kategori
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('laporan.index') }}">
                                <i class="fas fa-clipboard-list"></i>Kelola Laporan
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Submenu Relokasi -->
                <li>
                    <a class="dropdown-item" href="{{ route('admin.relokasi.index') }}">
                        <i class="fas fa-exchange-alt"></i>Relokasi
                    </a>
                </li>
            </ul>
        </li>
         <li>
    <a href="{{ route('wilayah.index') }}">
        <i class="fas fa-map-marker-alt"></i>Wilayah
    </a>
</li>
        <li>
            <a href="{{ route('teknisiAdmin.index') }}">
                <i class="fas fa-users-cog"></i>Teknisi
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}">
                <i class="fas fa-user-circle"></i>Account
            </a>
        </li>
        <li>
            <a href="{{ route('admin.guests.index') }}">
                <i class="fas fa-user-friends"></i>Guest Accounts
            </a>
        </li>
    </ul>

    <div class="logout-section">
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="logout-link">
            <i class="fas fa-sign-out-alt"></i>Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.querySelector('.sidebar-toggle');

        // Toggle sidebar on mobile
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 992 &&
                !sidebar.contains(event.target) &&
                !sidebarToggle.contains(event.target) &&
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });

        // Handle all dropdowns (including nested ones)
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const parentLi = this.closest('li');
                const dropdownMenu = parentLi.querySelector(':scope > .dropdown-menu');

                // Close other dropdowns at the same level
                const siblings = parentLi.parentElement.querySelectorAll(':scope > li');
                siblings.forEach(sibling => {
                    if (sibling !== parentLi) {
                        sibling.querySelector('.dropdown-toggle')?.classList.remove('show');
                        sibling.querySelector('.dropdown-menu')?.classList.remove('show');
                    }
                });

                // Toggle current dropdown
                if (dropdownMenu) {
                    this.classList.toggle('show');
                    dropdownMenu.classList.toggle('show');
                }
            });
        });

        // Prevent dropdown menu clicks from closing the dropdown
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.addEventListener('click', function(e) {
                if (e.target === this) {
                    e.stopPropagation();
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('show');
            }
        });
    });
</script>
