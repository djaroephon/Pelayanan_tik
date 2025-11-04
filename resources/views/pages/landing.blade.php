<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Layanan TIK | Diskominfo Aceh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <style>
        :root {
            --primary-color: #1c908d;
            --secondary-color: #156d6a;
            --accent-color: #ffc107;
            --dark-color: #0f4c4a;
            --light-color: #f8f9fa;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            font-family: "Poppins", sans-serif;
            scroll-behavior: smooth;
        }

        body, html {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Hero Section */
        #home {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            overflow: hidden;
        }

        .hero-content {
            text-align: center;
            max-width: 800px;
            padding: 2rem;
            z-index: 2;
            position: relative;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .hero-btn {
            background-color: var(--accent-color);
            border: none;
            color: #333;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-size: 1.1rem;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }

        .hero-btn:hover {
            background-color: #e0a800;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
        }

        /* Hero Image */
        .hero-image {
            position: absolute;
            right: 10%;
            bottom: 0;
            max-width: 40%;
            height: auto;
            z-index: 1;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));
        }

        /* Floating Elements */
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* About Section */
        #about {
            padding: 5rem 0;
            background-color: var(--light-color);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            text-align: center;
            color: var(--dark-color);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent-color);
            border-radius: 2px;
        }

        .about-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
        }

        .about-img {
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .about-img:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        /* Services Section */
        #services {
            padding: 5rem 0;
            background: white;
        }

        .service-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: var(--transition);
            height: 100%;
            border-top: 4px solid var(--primary-color);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .service-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .service-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .service-desc {
            color: #666;
            line-height: 1.6;
        }

        /* Contact Section */
        #contact {
            padding: 5rem 0;
            background: var(--light-color);
        }

        .contact-info {
            margin-bottom: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            margin-right: 1rem;
        }

        .contact-details h4 {
            margin-bottom: 0.25rem;
            color: var(--dark-color);
        }

        .contact-details p {
            margin: 0;
            color: #666;
        }

        .map-container {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* Footer */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 3rem 0 1.5rem;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .footer-logo img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            background: white;
            border-radius: 8px;
            padding: 5px;
        }

        .footer-links h5 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer-links h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--accent-color);
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 1.5rem;
            margin-top: 2rem;
            text-align: center;
            color: rgba(255,255,255,0.7);
        }

        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 767.98px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .service-card {
                margin-bottom: 1.5rem;
            }

            .map-container {
                margin-bottom: 2rem;
            }

            .hero-image {
                display: none;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            .hero-title {
                font-size: 3rem;
            }

            .hero-image {
                max-width: 35%;
            }
        }
        #preloader {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2000;
    flex-direction: column;
    overflow: hidden;
}

.preloader-content {
    text-align: center;
    color: white;
}

#preloader-text {
    font-size: 2rem;
    font-weight: 700;
    letter-spacing: 4px;
    text-transform: uppercase;
}

.loading-bar {
    width: 0%;
    height: 4px;
    background: var(--accent-color);
    margin-top: 20px;
    border-radius: 4px;
}

.preloader-logo {
    width: 80px;
    height: auto;
    margin-bottom: 15px;
    opacity: 0;
    transform: scale(0.8);
    filter: drop-shadow(0 0 8px rgba(0, 255, 150, 0.8));
    animation: logoGlow 2s infinite alternate ease-in-out;
}

@keyframes logoGlow {
    0% {
        filter: drop-shadow(0 0 5px rgba(0, 255, 150, 0.6))
                drop-shadow(0 0 10px rgba(0, 255, 150, 0.6));
        transform: scale(1);
    }
    100% {
        filter: drop-shadow(0 0 20px rgba(0, 255, 200, 1))
                drop-shadow(0 0 40px rgba(0, 255, 200, 0.9));
        transform: scale(1.05);
    }
}

    </style>
</head>
<body>

     <div id="preloader">
        <div class="preloader-content">
            <img src="{{ asset('images/logo-pancacita.png') }}" alt="Logo" class="preloader-logo">
            <h1 id="preloader-text">DISKOMINSA ACEH</h1>
            <div class="loading-bar"></div>
        </div>
    </div>

    @include('components.navbar')

    @if(session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible fade show position-fixed top-10 start-0 end-0 m-3 mx-auto" role="alert" style="max-width: 600px; z-index: 1100; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <section id="home">
        <div class="floating-elements">
        </div>
        <div class="hero-content fade-in">
            <h1 class="hero-title">Layanan Teknologi Informasi & Komunikasi</h1>
            <p class="hero-subtitle">Platform digital untuk pelaporan dan penyelesaian masalah TIK di lingkungan Diskominsa Aceh</p>
            <a href="{{ route('guest.login') }}" class="btn hero-btn">Akses Layanan <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </section>

    <section id="about" class="fade-in">
        <div class="container">
            <h2 class="section-title">Tentang Layanan TIK</h2>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-content">
                        <p>Layanan TIK Diskominsa Aceh merupakan platform digital yang dirancang untuk memudahkan pelaporan dan penyelesaian masalah Teknologi Informasi dan Komunikasi di lingkungan pemerintah Aceh.</p>
                        <p>Dengan sistem yang terintegrasi, kami menyediakan layanan cepat, transparan, dan akuntabel untuk mendukung operasional teknologi informasi yang optimal.</p>
                        <p>Platform ini memungkinkan pengguna untuk melaporkan masalah, melacak status penyelesaian, dan mendapatkan solusi tepat waktu dari tim teknis kami.</p>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('images/bg1.png') }}" alt="Tentang Layanan TIK" class="img-fluid about-img" />
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="fade-in">
        <div class="container">
            <h2 class="section-title">Layanan Kami</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h3 class="service-title">Pelaporan Masalah</h3>
                        <p class="service-desc">Laporkan masalah TIK yang Anda alami untuk segera ditangani oleh tim teknis kami.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-server"></i>
                        </div>
                        <h3 class="service-title">Ajukan Relokasi</h3>
                        <p class="service-desc">Ajukan permohonan relokasi perangkat TIK ke lokasi yang diinginkan.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-server"></i>
                        </div>
                        <h3 class="service-title">Colocation</h3>
                        <p class="service-desc">Layanan penempatan server di data center yang aman dan terkelola dengan baik.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="service-title">Email AcehProv</h3>
                        <p class="service-desc">Layanan email untuk instansi Pemerintah Aceh.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="service-title">Pentest</h3>
                        <p class="service-desc">Layanan penetration testing untuk menguji keamanan sistem informasi Anda.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h3 class="service-title">Ajukan VPN</h3>
                        <p class="service-desc">Ajukan permohonan akses VPN untuk keperluan kerja yang aman dan terenkripsi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="fade-in">
        <div class="container">
            <h2 class="section-title">Hubungi Kami</h2>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Lokasi</h4>
                                <p>Kantor Sentral Telematika Diskominfo dan Persandian Aceh</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Email</h4>
                                <p><a href="mailto:support@tik.id" class="text-decoration-none">support@tik.id</a></p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Jam Operasional</h4>
                                <p>Senin - Jumat: 08:00 - 16:00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4493.195131909602!2d95.34194226775834!3d5.571295061765319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304037006487d5bb%3A0xb918a180d9c43b79!2sKantor%20Sentral%20Telematika%20Diskominfo%20dan%20Persandian%20Aceh!5e1!3m2!1sen!2sid!4v1755001908251!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="w-100" height="300"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-logo">
                        <img src="{{ asset('images/logo-pancacita.png') }}" alt="Diskominfo Logo" />
                        <span>Diskominsa Aceh</span>
                    </div>
                    <p>Pusat Layanan Teknologi Informasi dan Komunikasi Pemerintah Aceh.</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="footer-links">
                        <h5>Tautan Cepat</h5>
                        <ul>
                            <li><a href="#home">Beranda</a></li>
                            <li><a href="#about">Tentang</a></li>
                            <li><a href="#services">Layanan</a></li>
                            <li><a href="#contact">Kontak</a></li>
                            <li><a href="{{ route('guest.login') }}">Login Layanan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="footer-links">
                        <h5>Layanan</h5>
                        <ul>
                            <li><a href="#">Pelaporan Masalah</a></li>
                            <li><a href="#">Ajukan Relokasi</a></li>
                            <li><a href="#">Colocation</a></li>
                            <li><a href="#">Operator Vmix</a></li>
                            <li><a href="#">Pentest</a></li>
                            <li><a href="#">Ajukan VPN</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Diskominsa Aceh. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const floatingContainer = document.querySelector('.floating-elements');
            const colors = ['rgba(255,255,255,0.1)', 'rgba(255,255,255,0.15)', 'rgba(255,255,255,0.2)'];

            for (let i = 0; i < 25; i++) {
                const element = document.createElement('div');
                element.classList.add('floating-element');

                const size = Math.random() * 60 + 20;
                const left = Math.random() * 100;
                const top = Math.random() * 100;
                const delay = Math.random() * 5;
                const duration = Math.random() * 3 + 4;
                const color = colors[Math.floor(Math.random() * colors.length)];

                element.style.width = `${size}px`;
                element.style.height = `${size}px`;
                element.style.left = `${left}%`;
                element.style.top = `${top}%`;
                element.style.animationDelay = `${delay}s`;
                element.style.animationDuration = `${duration}s`;
                element.style.background = color;

                floatingContainer.appendChild(element);
            }

            const fadeEls = document.querySelectorAll('.fade-in');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if(entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.2 });

            fadeEls.forEach(el => observer.observe(el));

            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.classList.remove('show');
                    setTimeout(() => alert.remove(), 150);
                }, 5000);
            }
        });
  document.addEventListener("DOMContentLoaded", function() {
    anime.timeline({ loop: false })
        .add({
            targets: '.preloader-logo',
            opacity: [0, 1],
            scale: [0.8, 1],
            easing: "easeOutBack",
            duration: 800
        })
        .add({
            targets: '#preloader-text',
            translateY: [-50, 0],
            opacity: [0, 1],
            easing: "easeOutExpo",
            duration: 1000
        })
        .add({
            targets: '.loading-bar',
            width: ['0%', '100%'],
            easing: "easeInOutQuad",
            duration: 1500,
            delay: 300
        })
        .add({
            targets: '#preloader',
            opacity: [1, 0],
            easing: "easeInOutQuad",
            duration: 800,
            delay: 500,
            complete: function() {
                document.getElementById('preloader').style.display = 'none';
            }
        });
});
    </script>
</body>
</html>
