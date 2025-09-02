<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Layanan TIK | home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/font.css') }}" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <style>
        * { font-family: "Poppins", sans-serif; scroll-behavior: smooth; }
        body, html { margin: 0; padding: 0; }
        #home {
            background-image: url('{{ asset('images/123.jpg') }}');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            overflow: hidden;
        }
        #home .overlay {
            background: rgba(0,0,0,0.5);
            padding: 3rem 2rem;
            border-radius: 10px;
            text-align: center;
            max-width: 600px;
            position: relative;
            z-index: 2;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
            top: 0; left: 0;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s ease-out;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
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


        @media (max-width: 767.98px) {
            #home .overlay {
                padding: 2rem 1rem;
                max-width: 90%;
            }
            #about img {
                margin-top: 1.5rem;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            #home .overlay {
                padding: 2.5rem 2rem;
                max-width: 80%;
            }
        }

        iframe {
            min-height: 300px;
            width: 100%;
            border: none;
        }

@media (max-width: 767.98px) {
    .navbar-nav {
        text-align: center;
    }
    .btn-container {
        flex-direction: column !important;
        align-items: center;
    }
    #home {
        background-attachment: scroll;
    }

    #home .overlay {
        padding: 2rem 1rem;
        max-width: 95%;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    #home .overlay {
        padding: 2.5rem 2rem;
        max-width: 80%;
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
<div
    id="success-alert"
    class="alert alert-success alert-dismissible fade show position-fixed top-10 start-0 end-0 m-3 mx-auto"
    role="alert"
    style="max-width: 600px; z-index: 1100; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<section id="home">
    <div id="particles-js"></div>
    <div class="overlay fade-in">
        <h1 class="display-4 fw-bold">Selamat Datang di Pelayanan TIK</h1>
        <p class="lead">Platform Layanan Masalah TIK</p>
        <a href="{{ route('guest.login') }}" class="btn btn-success btn-lg mt-3">Lihat layanan</a>
    </div>
</section>

<section id="about" class="py-5 fade-in">
    <div class="container">
        <h2 class="text-center mb-5">Tentang Kami</h2>
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="fs-5">
                    Pelayanan TIK memudahkan pelaporan masalah Teknologi Informasi dan Komunikasi dengan sistem digital yang efisien dan transparan.
                </p>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/bg1.png') }}" alt="Tentang Kami" class="img-fluid rounded shadow" />
            </div>
        </div>
    </div>
</section>

<section id="contact" class="py-5 bg-light fade-in">
    <div class="container">
        <h2 class="text-center mb-5">Kontak</h2>
        <div class="row align-items-center">
            <div class="col-md-6 mb-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4493.195131909602!2d95.34194226775834!3d5.571295061765319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304037006487d5bb%3A0xb918a180d9c43b79!2sKantor%20Sentral%20Telematika%20Diskominfo%20dan%20Persandian%20Aceh!5e1!3m2!1sen!2sid!4v1755001908251!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded shadow w-100"></iframe>
            </div>
            <div class="col-md-6">
                <p class="fs-5">Hubungi kami: <a href="mailto:support@tik.id" class="fw-bold">support@tik.id</a></p>
                <p class="fw-semibold">Kantor Sentral Telematika Diskominfo dan Persandian Aceh</p>
            </div>
        </div>
    </div>
</section>

@include('components.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
    particlesJS("particles-js", {
        particles: {
            number: { value: 80, density: { enable: true, value_area: 800 } },
            color: { value: "#ffffff" },
            shape: { type: "circle" },
            opacity: { value: 1.5, random: true },
            size: { value: 3, random: true },
            move: { enable: true, speed: 2, direction: "none", out_mode: "out" },
            line_linked: { enable: true, distance: 150, color: "#ffffff", opacity: 0.4, width: 1 }

        }
    });

    // Fade In Animation Trigger
    const fadeEls = document.querySelectorAll('.fade-in');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.2 });
    fadeEls.forEach(el => observer.observe(el));

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
