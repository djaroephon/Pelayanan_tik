<style>
        :root {
            --primary-color: #1c908d;
            --secondary-color: #156d6a;
            --accent-color: #ffc107;
            --dark-color: #0f4c4a;
            --light-color: #f8f9fa;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 1rem 1rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: var(--transition);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .navbar.scrolled {
            padding: 0.6rem 1rem;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
            background: rgba(28, 144, 141, 0.95);
        }

        .navbar-brand {
            color: white;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            transition: var(--transition);
            font-size: 1.25rem;
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
            color: white;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            margin-right: 12px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            transition: var(--transition);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 5px;
        }

        .navbar-brand:hover .logo-container {
            transform: rotate(5deg) scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .logo-svg {
            width: 100%;
            height: 100%;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            position: relative;
            transition: var(--transition);
            margin: 0 0.5rem;
            padding: 0.5rem 0.75rem !important;
            border-radius: 6px;
        }

        .nav-link:hover, .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.15);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: white;
            transition: var(--transition);
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 80%;
        }

        .btn-container {
            gap: 0.75rem;
        }

        .btn-report {
            background-color: var(--accent-color);
            font-weight: 600;
            color: #333;
            transition: var(--transition);
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            box-shadow: 0 4px 10px rgba(255, 193, 7, 0.3);
        }

        .btn-report:hover {
            background-color: #e0a800;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(255, 193, 7, 0.4);
        }

        .btn-login {
            background-color: white;
            color: var(--primary-color);
            font-weight: 600;
            transition: var(--transition);
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.3);
        }

        .btn-login:hover {
            background-color: #f5f5f5;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(255, 255, 255, 0.4);
        }

        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: rgba(28, 144, 141, 0.98);
                border-radius: 12px;
                margin-top: 1rem;
                padding: 1rem;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            }

            .nav-link {
                margin: 0.25rem 0;
                text-align: center;
            }

            .btn-container {
                flex-direction: column;
                width: 100%;
                margin-top: 1rem;
            }

            .btn-report, .btn-login {
                width: 100%;
                text-align: center;
            }
        }
    </style>

 <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <div class="logo-container">
                    <img src="{{ asset('images/logo-pancacita.png') }}" alt="Diskominsa Logo" class="logo-svg" />
                </div>
                Diskominsa Aceh
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-3 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul>
                <div class="d-flex flex-column flex-lg-row gap-2 btn-container">
                    <a href="{{ route('guest.login') }}" class="btn btn-report">
                        <i class="fas fa-bullhorn me-2"></i>Akses Layanan
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

  <script>
        window.addEventListener('scroll', function(){
            const navbar = document.querySelector('.navbar');
            if(window.scrollY > 50){
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Close navbar when clicking on a link (for mobile)
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');

            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (navbarCollapse.classList.contains('show')) {
                        navbarToggler.click();
                    }
                });
            });
        });
    </script>
