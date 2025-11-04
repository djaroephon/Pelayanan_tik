<style>
    :root {
        --primary-color: #1c908d;
        --secondary-color: #156d6a;
        --accent-color: #ffc107;
        --light-color: #f8f9fa;
        --dark-color: #0f4c4a;
        --sidebar-width: 280px;
        --transition: all 0.3s ease;
    }

    .sidebar {
        background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
        color: white;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        width: var(--sidebar-width);
        padding: 0;
        box-shadow: 3px 0 20px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        transition: var(--transition);
    }

    .sidebar-brand {
        text-align: center;
        padding: 25px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 10px;
        background: rgba(0, 0, 0, 0.1);
    }

    .sidebar-brand h4 {
        font-weight: 700;
        margin: 0;
        font-size: 1.4rem;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sidebar-brand i {
        margin-right: 10px;
        font-size: 1.5rem;
    }

    .user-info {
        padding: 25px 20px;
        text-align: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        margin-bottom: 15px;
        background: rgba(255, 255, 255, 0.05);
    }

    .user-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        color: var(--primary-color);
        font-size: 2.2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: var(--transition);
    }

    .user-avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 7px 20px rgba(0, 0, 0, 0.15);
    }

    .user-info h5 {
        margin-bottom: 8px;
        font-size: 1.2rem;
        font-weight: 600;
    }

    .user-info p {
        margin-bottom: 5px;
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .nav-container {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 0 15px 15px;
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.9);
        padding: 12px 18px;
        margin: 5px 0;
        border-radius: 10px;
        transition: var(--transition);
        font-size: 1rem;
        display: flex;
        align-items: center;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        transition: var(--transition);
    }

    .nav-link:hover::before, .nav-link.active::before {
        left: 0;
    }

    .nav-link:hover, .nav-link.active {
        background-color: rgba(255, 255, 255, 0.15);
        color: white;
        transform: translateX(5px);
    }

    .nav-link i {
        margin-right: 15px;
        font-size: 1.2rem;
        width: 24px;
        text-align: center;
        transition: var(--transition);
    }

    .nav-link:hover i, .nav-link.active i {
        transform: scale(1.1);
    }

    .nav-footer {
        padding: 20px 15px;
        margin-top: auto;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(0, 0, 0, 0.1);
    }

    .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 12px;
        background: rgba(220, 53, 69, 0.8);
        color: white;
        border: none;
        border-radius: 10px;
        transition: var(--transition);
        font-size: 1rem;
        font-weight: 500;
    }

    .logout-btn:hover {
        background: rgba(220, 53, 69, 1);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .logout-btn i {
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .animate-item {
        opacity: 0;
        transform: translateY(20px);
    }

    /* Mobile Toggle - Diperbarui untuk tampil di mobile */
    .mobile-toggle {
        display: none;
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 1100;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: var(--transition);
    }

    .mobile-toggle:hover {
        background: var(--secondary-color);
        transform: scale(1.05);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
            width: 270px;
        }

        .sidebar.active {
            transform: translateX(0);
            box-shadow: 3px 0 25px rgba(0, 0, 0, 0.2);
        }

        .mobile-toggle {
            display: block;
        }
    }

    @media (max-width: 576px) {
        .sidebar {
            width: 260px;
        }

        .user-info {
            padding: 20px 15px;
        }

        .user-avatar {
            width: 70px;
            height: 70px;
            font-size: 1.8rem;
        }

        .nav-container {
            padding: 0 10px 10px;
        }

        .nav-link {
            padding: 10px 15px;
            font-size: 0.95rem;
        }

        .mobile-toggle {
            top: 15px;
            left: 15px;
            padding: 10px 13px;
        }
    }

    /* Custom Scrollbar */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }
</style>

<!-- Mobile Toggle Button (ditambahkan di sini juga untuk memastikan tampil di mobile) -->
<button class="mobile-toggle" id="sidebarToggle">
    <i class="fas fa-bars"></i>
</button>

<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <h4><i class="bi bi-shield-check"></i> Portal Guest</h4>
    </div>

    <div class="user-info">
        <div class="user-avatar">
            <i class="bi bi-person-circle"></i>
        </div>
        <h5 id="guest-name">{{ $guest->nama_pelapor }}</h5>
        <p id="guest-nip">NIP: {{ $guest->nip }}</p>
        <p id="guest-instansi" class="text-capitalize">{{ $guest->instansi }}</p>
    </div>

    <div class="nav-container">
        <nav class="nav flex-column">
            <a class="nav-link active animate-item" href="{{route('guest.home')}}">
                <i class="bi bi-house-door"></i> Beranda
            </a>
            <a class="nav-link animate-item" href="{{route('guest.laporan.saya')}}">
                <i class="bi bi-file-text"></i> Laporan Saya
            </a>
        </nav>
    </div>

    <div class="nav-footer">
        <form id="logout-form" action="{{ route('guest.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn animate-item">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        // Toggle sidebar on mobile
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                sidebar.classList.toggle('active');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 992) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickInsideToggle = sidebarToggle.contains(event.target);
                if (!isClickInsideSidebar && !isClickInsideToggle && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('active');
            }
        });

        // Animation for sidebar items
        anime({
            targets: '.animate-item',
            translateY: 0,
            opacity: 1,
            delay: anime.stagger(100),
            duration: 800,
            easing: 'easeOutQuart'
        });
    });
</script>
