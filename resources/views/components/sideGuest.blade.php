<style>
    :root {
            --primary-color: #1c908d;
            --secondary-color: #156d6a;
            --accent-color: #f8f9fa;
            --text-color: #333;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: var(--text-color);
        }

        .sidebar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            padding: 15px 0;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            text-align: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 15px;
        }

        .user-info {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 15px;
        }

        .user-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: var(--primary-color);
            font-size: 1.8rem;
        }

        .user-info h5 {
            margin-bottom: 5px;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .user-info p {
            margin-bottom: 4px;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .nav-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 0 10px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 10px 15px;
            margin: 4px 5px;
            border-radius: 6px;
            transition: all 0.2s;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(255, 255, 255, 0.12);
            color: white;
            transform: translateX(3px);
        }

        .nav-link i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .nav-footer {
            padding: 15px;
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border: none;
            border-radius: 6px;
            transition: all 0.2s;
            font-size: 0.95rem;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .logout-btn i {
            margin-right: 8px;
        }

        .animate-item {
            opacity: 0;
            transform: translateY(20px);
        }
.sidebar.active .sidebar-brand {
    display: none;
}
         .mobile-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1.2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
         @media (max-width: 992px) {
             .sidebar {
                transform: translateX(-100%);
                width: 250px;
            }
            .sidebar.active {
                transform: translateX(0);
                box-shadow: 3px 0 15px rgba(0, 0, 0, 0.2);
            }
             .mobile-toggle {
                display: block;
            }
        }
        @media (max-width: 576px) {

            .mobile-toggle {
                top: 15px;
                left: 15px;
                padding: 8px 12px;
            }
        }
    </style>

 <button class="mobile-toggle" id="sidebarToggle">
    <i class="bi bi-list"></i>
</button>


    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="bi bi-shield-check"></i> Portal LanTIK</h4>
        </div>

        <div class="user-info">
            <div class="user-avatar">
                <i class="bi bi-person-circle"></i>
            </div>
            <h5 id="guest-name">{{ $guest->nama_pelapor }}</h5>
            <p id="guest-nip">NIP: {{ $guest->nip }}</p>
            <p id="guest-instansi">Instansi: {{ $guest->instansi }}</p>
        </div>

        <div class="nav-container">
            <nav class="nav flex-column">
                <a class="nav-link active" href="{{route('guest.home')}}"><i class="bi bi-house-door"></i> Beranda</a>
                <a class="nav-link" href="{{route('guest.laporan.saya')}}"><i class="bi bi-file-text"></i> Laporan Saya</a>
            </nav>
        </div>

        <div class="nav-footer">
            <form id="logout-form" action="{{ route('guest.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mainContent = document.getElementById('main-content');

        function closeSidebar() {
            if (sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        }

        sidebarToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.toggle('active');

        });

        document.addEventListener('click', function(event) {
            if (window.innerWidth < 992) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickInsideToggle = sidebarToggle.contains(event.target);
                if (!isClickInsideSidebar && !isClickInsideToggle) {
                    closeSidebar();
                }
            }
        });

        sidebar.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('active');
            }
        });

        Animasi untuk item-item di sidebar (Opsional, pastikan Anime.js dimuat)
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
