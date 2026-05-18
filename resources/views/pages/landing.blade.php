@extends('layouts.main')

@section('title', 'Layanan TIK | Diskominsa Aceh')

@section('content')
<!-- Hero Section -->
<section id="home" class="relative flex min-h-screen items-center justify-center overflow-hidden pt-20">
    <!-- Background Elements -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 -left-4 w-48 h-48 md:w-72 md:h-72 bg-primary-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-48 h-48 md:w-72 md:h-72 bg-accent-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-48 h-48 md:w-72 md:h-72 bg-primary-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-[0.03]"></div>
    </div>

    <div class="container relative z-10 mx-auto px-6 text-center mt-10 md:mt-0">
        <div class="hero-text opacity-0">
            <span class="mb-4 inline-block rounded-full bg-primary-100 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-primary-700">Diskominsa Aceh</span>
            <h1 class="font-display mb-6 text-4xl font-extrabold leading-snug tracking-tight text-surface-900 md:text-6xl lg:text-7xl lg:leading-tight">
                Transformasi Digital <br class="hidden sm:block">
                <span class="bg-gradient-to-r from-primary-600 to-accent-600 bg-clip-text text-transparent">Layanan TIK</span>
            </h1>
            <p class="mx-auto mb-10 max-w-2xl text-lg font-medium leading-relaxed text-surface-800 md:text-xl">
                Platform modern untuk pelaporan dan pengelolaan layanan Teknologi Informasi & Komunikasi di lingkungan Pemerintah Aceh yang lebih cepat, transparan, dan akuntabel.
            </p>
            <div class="flex flex-col items-center justify-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                <a href="{{ route('guest.login') }}" class="group flex items-center space-x-2 rounded-2xl bg-primary-600 px-8 py-4 text-lg font-bold text-white shadow-xl shadow-primary-600/20 transition-all hover:bg-primary-700 active:scale-95 w-full sm:w-auto justify-center">
                    <span>Mulai Sekarang</span>
                    <i data-lucide="arrow-right" class="h-5 w-5 transition-transform group-hover:translate-x-1"></i>
                </a>
                <a href="#about" class="rounded-2xl border border-surface-200 bg-white/50 px-8 py-4 text-lg font-bold text-surface-800 backdrop-blur-sm transition-all hover:bg-white hover:text-surface-900 hover:border-surface-300 active:scale-95 w-full sm:w-auto text-center">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </div>

    <!-- Floating Dashboard Preview (Optional) -->
    <div class="absolute -bottom-64 left-1/2 w-full max-w-5xl -translate-x-1/2 px-6 hero-image opacity-0 md:block hidden">
        <div class="glass overflow-hidden rounded-3xl p-2 shadow-2xl">
            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop" alt="Dashboard Preview" class="rounded-2xl shadow-inner">
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="bg-white py-24">
    <div class="container mx-auto px-6">
        <div class="flex flex-col items-center gap-16 md:flex-row">
            <div class="w-full space-y-8 md:w-1/2 about-text opacity-0">
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-100 text-primary-600">
                    <i data-lucide="info" class="h-6 w-6"></i>
                </div>
                <h2 class="font-display text-4xl font-bold tracking-tight text-surface-900">Tentang Layanan TIK</h2>
                <div class="space-y-4 text-lg leading-relaxed text-surface-700">
                    <p>Layanan TIK Diskominsa Aceh dirancang sebagai jembatan digital antara kebutuhan teknologi informasi dan solusi teknis bagi seluruh instansi di lingkungan Pemerintah Aceh.</p>
                    <p>Kami mengintegrasikan sistem pelaporan, manajemen inventaris, dan bantuan teknis ke dalam satu platform yang intuitif dan responsif untuk memastikan kesinambungan operasional pemerintahan berbasis elektronik.</p>
                </div>
                <div class="grid grid-cols-2 gap-6 pt-4">
                    <div class="space-y-2">
                        <div class="text-3xl font-bold text-primary-600">24/7</div>
                        <div class="text-sm font-medium text-surface-600">Monitoring Sistem</div>
                    </div>
                    <div class="space-y-2">
                        <div class="text-3xl font-bold text-primary-600">Cepat</div>
                        <div class="text-sm font-medium text-surface-600">Respon Penanganan</div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 about-image opacity-0">
                <div class="relative overflow-hidden rounded-3xl shadow-xl">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2026&auto=format&fit=crop" alt="Technology Work" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-900/40 to-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="bg-surface-50 py-24">
    <div class="container mx-auto px-6">
        <div class="mb-16 text-center services-header opacity-0">
            <h2 class="font-display mb-4 text-4xl font-bold tracking-tight text-surface-900">Layanan Unggulan Kami</h2>
            <p class="mx-auto max-w-2xl text-lg text-surface-700">Kami menyediakan berbagai layanan teknologi informasi terintegrasi untuk mendukung transformasi digital pemerintahan.</p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            <!-- Service Card 1 -->
            <div class="service-card group relative overflow-hidden rounded-3xl bg-white p-8 shadow-md border border-surface-100 transition-all hover:-translate-y-2 hover:shadow-xl hover:border-primary-100 opacity-0">
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 transition-colors group-hover:bg-primary-600 group-hover:text-white">
                    <i data-lucide="message-square" class="h-7 w-7"></i>
                </div>
                <h3 class="font-display mb-4 text-xl font-bold text-surface-900">Pelaporan Masalah</h3>
                <p class="mb-6 text-surface-600 leading-relaxed">Sistem tiket modern untuk melaporkan kendala teknis TIK secara langsung kepada tim ahli kami.</p>
                <div class="h-1 w-0 bg-primary-600 transition-all duration-300 group-hover:w-full"></div>
            </div>

            <!-- Service Card 2 -->
            <div class="service-card group relative overflow-hidden rounded-3xl bg-white p-8 shadow-md border border-surface-100 transition-all hover:-translate-y-2 hover:shadow-xl hover:border-primary-100 opacity-0">
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 transition-colors group-hover:bg-primary-600 group-hover:text-white">
                    <i data-lucide="server" class="h-7 w-7"></i>
                </div>
                <h3 class="font-display mb-4 text-xl font-bold text-surface-900">Colocation Server</h3>
                <p class="mb-6 text-surface-600 leading-relaxed">Layanan penempatan infrastruktur server di data center yang aman, stabil, dan terkelola.</p>
                <div class="h-1 w-0 bg-primary-600 transition-all duration-300 group-hover:w-full"></div>
            </div>

            <!-- Service Card 3 -->
            <div class="service-card group relative overflow-hidden rounded-3xl bg-white p-8 shadow-md border border-surface-100 transition-all hover:-translate-y-2 hover:shadow-xl hover:border-primary-100 opacity-0">
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 transition-colors group-hover:bg-primary-600 group-hover:text-white">
                    <i data-lucide="mail" class="h-7 w-7"></i>
                </div>
                <h3 class="font-display mb-4 text-xl font-bold text-surface-900">Email AcehProv</h3>
                <p class="mb-6 text-surface-600 leading-relaxed">Layanan email resmi Pemerintah Aceh untuk komunikasi kedinasan yang aman dan profesional.</p>
                <div class="h-1 w-0 bg-primary-600 transition-all duration-300 group-hover:w-full"></div>
            </div>

            <!-- Service Card 4 -->
            <div class="service-card group relative overflow-hidden rounded-3xl bg-white p-8 shadow-md border border-surface-100 transition-all hover:-translate-y-2 hover:shadow-xl hover:border-primary-100 opacity-0">
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 transition-colors group-hover:bg-primary-600 group-hover:text-white">
                    <i data-lucide="shield-check" class="h-7 w-7"></i>
                </div>
                <h3 class="font-display mb-4 text-xl font-bold text-surface-900">Keamanan Siber</h3>
                <p class="mb-6 text-surface-600 leading-relaxed">Audit keamanan dan penetration testing untuk memastikan sistem informasi Anda terlindungi.</p>
                <div class="h-1 w-0 bg-primary-600 transition-all duration-300 group-hover:w-full"></div>
            </div>

            <!-- Service Card 5 -->
            <div class="service-card group relative overflow-hidden rounded-3xl bg-white p-8 shadow-md border border-surface-100 transition-all hover:-translate-y-2 hover:shadow-xl hover:border-primary-100 opacity-0">
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 transition-colors group-hover:bg-primary-600 group-hover:text-white">
                    <i data-lucide="move" class="h-7 w-7"></i>
                </div>
                <h3 class="font-display mb-4 text-xl font-bold text-surface-900">Relokasi Perangkat</h3>
                <p class="mb-6 text-surface-600 leading-relaxed">Pendampingan teknis pemindahan perangkat TIK antar lokasi instansi secara aman.</p>
                <div class="h-1 w-0 bg-primary-600 transition-all duration-300 group-hover:w-full"></div>
            </div>

            <!-- Service Card 6 -->
            <div class="service-card group relative overflow-hidden rounded-3xl bg-white p-8 shadow-md border border-surface-100 transition-all hover:-translate-y-2 hover:shadow-xl hover:border-primary-100 opacity-0">
                <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-50 text-primary-600 transition-colors group-hover:bg-primary-600 group-hover:text-white">
                    <i data-lucide="lock" class="h-7 w-7"></i>
                </div>
                <h3 class="font-display mb-4 text-xl font-bold text-surface-900">Akses VPN</h3>
                <p class="mb-6 text-surface-600 leading-relaxed">Penyediaan akses jaringan pribadi virtual untuk bekerja dari jarak jauh dengan aman.</p>
                <div class="h-1 w-0 bg-primary-600 transition-all duration-300 group-hover:w-full"></div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="bg-white py-24">
    <div class="container mx-auto px-6">
        <div class="overflow-hidden rounded-[3rem] bg-surface-900 text-white shadow-2xl contact-card opacity-0">
            <div class="flex flex-col md:flex-row">
                <div class="w-full p-10 md:w-1/2 lg:p-16">
                    <h2 class="font-display mb-6 text-3xl md:text-4xl font-bold tracking-tight">Butuh Bantuan Lebih Lanjut?</h2>
                    <p class="mb-10 text-lg text-slate-300">Tim kami siap membantu Anda menyelesaikan kendala teknologi informasi yang Anda hadapi.</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white/10 text-primary-400">
                                <i data-lucide="phone" class="h-6 w-6"></i>
                            </div>
                            <div>
                                <p class="text-sm text-slate-400">Telepon</p>
                                <p class="font-bold text-white">+62 123 4567 890</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white/10 text-primary-400">
                                <i data-lucide="mail" class="h-6 w-6"></i>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-sm text-slate-400">Email Dukungan</p>
                                <p class="font-bold text-white truncate max-w-[200px] sm:max-w-none">support@diskominsa.aceh.go.id</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white/10 text-primary-400">
                                <i data-lucide="map-pin" class="h-6 w-6"></i>
                            </div>
                            <div>
                                <p class="text-sm text-slate-400">Lokasi</p>
                                <p class="font-bold text-white">Jl. T. Nyak Arief No. 219, Banda Aceh</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative w-full overflow-hidden md:w-1/2 min-h-[300px]">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4493.195131909602!2d95.34194226775834!3d5.571295061765319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304037006487d5bb%3A0xb918a180d9c43b79!2sKantor%20Sentral%20Telematika%20Diskominfo%20dan%20Persandian%20Aceh!5e1!3m2!1sen!2sid!4v1755001908251!5m2!1sen!2sid" class="absolute inset-0 h-full w-full grayscale opacity-60 contrast-125" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Preloader Overlay -->
<div id="preloader" class="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-primary-600 transition-all duration-500">
    <div class="relative flex h-32 w-32 items-center justify-center">
        <div class="absolute inset-0 animate-ping rounded-full bg-white/20"></div>
        <img src="{{ asset('images/logo-pancacita.png') }}" alt="Logo" class="relative z-10 h-16 w-auto">
    </div>
    <h2 class="mt-8 font-display text-2xl font-bold tracking-widest text-white uppercase">Diskominsa Aceh</h2>
    <div class="mt-4 h-1 w-48 overflow-hidden rounded-full bg-white/20">
        <div id="preloader-bar" class="h-full w-0 bg-white transition-all duration-300"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Preloader Animation (Sped up)
        const preloader = document.getElementById('preloader');
        const preloaderBar = document.getElementById('preloader-bar');
        
        let width = 0;
        const interval = setInterval(() => {
            width += Math.random() * 40 + 20; // Faster steps
            if (width >= 100) {
                width = 100;
                clearInterval(interval);
                setTimeout(() => {
                    preloader.classList.add('opacity-0', 'invisible', '-translate-y-full');
                    startHeroAnimations();
                }, 300); // Shorter delay before hiding
            }
            preloaderBar.style.width = width + '%';
        }, 50); // Faster interval

        function startHeroAnimations() {
            anime({
                targets: '.hero-text',
                translateY: [30, 0],
                opacity: [0, 1],
                duration: 1000,
                easing: 'easeOutQuart'
            });

            anime({
                targets: '.hero-image',
                translateY: [50, 0],
                opacity: [0, 1],
                delay: 200,
                duration: 1200,
                easing: 'easeOutQuart'
            });
        }

        // Scroll Animations using Intersection Observer
        const observerOptions = {
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains('about-text')) {
                        anime({ targets: '.about-text', translateX: [-30, 0], opacity: [0, 1], duration: 800, easing: 'easeOutQuart' });
                    }
                    if (entry.target.classList.contains('about-image')) {
                        anime({ targets: '.about-image', translateX: [30, 0], opacity: [0, 1], duration: 800, easing: 'easeOutQuart' });
                    }
                    if (entry.target.classList.contains('services-header')) {
                        anime({ targets: '.services-header', translateY: [20, 0], opacity: [0, 1], duration: 800, easing: 'easeOutQuart' });
                    }
                    if (entry.target.classList.contains('service-card')) {
                        anime({ targets: '.service-card', translateY: [30, 0], opacity: [0, 1], delay: anime.stagger(100), duration: 800, easing: 'easeOutQuart' });
                    }
                    if (entry.target.classList.contains('contact-card')) {
                        anime({ targets: '.contact-card', scale: [0.98, 1], opacity: [0, 1], duration: 800, easing: 'easeOutQuart' });
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.opacity-0').forEach(el => observer.observe(el));
    });
</script>

<style>
    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
</style>
@endpush
