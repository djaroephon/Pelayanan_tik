<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Guest - Sistem Laporan TIK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
    <style>
        :root {
            --primary-color: #1c908d;
            --secondary-color: #156d6a;
            --accent-color: #ffc107;
            --light-color: #f8f9fa;
            --dark-color: #0f4c4a;
            --text-color: #333;
            --sidebar-width: 280px;
            --transition: all 0.3s ease;
        }

        * {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            background-color: #f5f5f5;
            color: var(--text-color);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            min-height: 100vh;
            transition: var(--transition);
        }

        .welcome-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
        }

        .welcome-section h1 {
            font-weight: 700;
            margin-bottom: 15px;
            position: relative;
        }

        .welcome-section .lead {
            font-size: 1.2rem;
            opacity: 0.9;
            position: relative;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .service-card {
            background-color: white;
            border-radius: 15px;
            padding: 30px 25px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: var(--transition);
            border: none;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .service-card.disabled {
            opacity: 0.7;
        }

        .service-card.disabled:hover {
            transform: none;
            cursor: not-allowed;
        }

        .service-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
            display: inline-block;
            padding: 15px;
            border-radius: 50%;
            background: rgba(28, 144, 141, 0.1);
            transition: var(--transition);
        }

        .service-card.disabled .service-icon {
            color: #6c757d;
            background: rgba(108, 117, 125, 0.1);
        }

        .service-card:hover .service-icon {
            transform: scale(1.1);
            background: rgba(28, 144, 141, 0.2);
        }

        .service-card.disabled:hover .service-icon {
            transform: none;
            background: rgba(108, 117, 125, 0.1);
        }

        .service-card h4 {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        .service-card.disabled h4 {
            color: #6c757d;
        }

        .service-card p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .service-card.disabled p {
            color: #8a8a8a;
        }

        /* Stats Cards */
        .stats-card {
            text-align: center;
            padding: 25px 20px;
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            height: 100%;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .stats-icon {
            font-size: 2.8rem;
            margin-bottom: 15px;
            display: inline-block;
            padding: 10px;
            border-radius: 50%;
            background: rgba(28, 144, 141, 0.1);
        }

        .stats-card h2 {
            font-weight: 700;
            margin: 10px 0;
            color: var(--dark-color);
        }

        .stats-card p {
            color: #666;
            margin: 0;
            font-weight: 500;
        }

        /* Footer Styles */
        .footer {
            background-color: white;
            padding: 25px 20px;
            border-top: 1px solid #eee;
            margin-top: 50px;
            border-radius: 15px 15px 0 0;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Animations */
        .animate-item {
            opacity: 0;
            transform: translateY(30px);
        }

        /* Mobile Toggle */
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

        /* Section Titles */
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: var(--dark-color);
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 70px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(28, 144, 141, 0.3);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(28, 144, 141, 0.3);
        }

        .btn-disabled {
            background: #6c757d;
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            color: white;
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* Coming Soon Badge */
        .coming-soon-badge {
            position: absolute;
            top: 15px;
            right: -30px;
            background: var(--accent-color);
            color: #333;
            padding: 5px 30px;
            font-size: 0.8rem;
            font-weight: 600;
            transform: rotate(45deg);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .services-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }

        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 80px 20px 20px;
            }

            .welcome-section {
                padding: 30px;
                margin-top: 10px;
            }

            .mobile-toggle {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .services-grid {
                grid-template-columns: 1fr;
            }

            .stats-card {
                margin-bottom: 20px;
            }

            .welcome-section h1 {
                font-size: 2rem;
            }

            .section-title {
                font-size: 1.7rem;
            }
        }

        @media (max-width: 576px) {
            .welcome-section {
                padding: 25px 20px;
            }

            .welcome-section .lead {
                font-size: 1.1rem;
            }

            .service-card {
                padding: 25px 20px;
            }

            .footer {
                padding: 20px 15px;
            }

            .mobile-toggle {
                top: 15px;
                left: 15px;
                padding: 10px 13px;
            }

            .main-content {
                padding: 70px 15px 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Toggle Button (Mobile Only) -->
    <button class="mobile-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Include Sidebar -->
    @include('components.sideGuest')

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        @if(session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show position-fixed top-10 start-0 end-0 m-3 mx-auto" role="alert" style="max-width: 600px; z-index: 1100; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.15);">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <div class="flex-grow-1">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        <div class="welcome-section animate-item">
            <h1>Selamat Datang di Portal Guest</h1>
            <p class="lead">Sistem Laporan Masalah Teknologi Informasi dan Komunikasi</p>
        </div>

        <h2 class="section-title animate-item">Layanan Tersedia</h2>
        <div class="services-grid">
            <!-- Layanan Aktif -->
            <div class="service-card animate-item">
                <div class="service-icon">
                    <i class="bi bi-clipboard-plus"></i>
                </div>
                <h4>Buat Laporan Baru</h4>
                <p>Ajukan laporan permasalahan TIK yang Anda alami untuk segera ditangani oleh tim teknis kami</p>
                <a href="/lapor" class="btn btn-primary mt-2">Ajukan Laporan</a>
            </div>

            <div class="service-card animate-item">
                <div class="service-icon">
                    <i class="bi bi-hdd-rack"></i>
                </div>
                <h4>Layanan Relocation</h4>
                <p>Permohonan relokasi perangkat TIK ke lokasi yang diinginkan dengan proses yang mudah dan cepat</p>
                <button type="button" class="btn btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#relokasiModal">
                    Ajukan Relokasi
                </button>
            </div>

            <!-- Layanan Baru (Disabled) -->
            <div class="service-card animate-item disabled">
                <div class="coming-soon-badge">Segera Hadir</div>
                <div class="service-icon">
                    <i class="bi bi-globe"></i>
                </div>
                <h4>IP Publik</h4>
                <p>Layanan alamat IP publik untuk kebutuhan akses eksternal dan hosting server</p>
                <button class="btn btn-disabled mt-2" disabled>Belum Tersedia</button>
            </div>

            <div class="service-card animate-item disabled">
                <div class="coming-soon-badge">Segera Hadir</div>
                <div class="service-icon">
                    <i class="bi bi-server"></i>
                </div>
                <h4>Colocation</h4>
                <p>Layanan penempatan server fisik di data center yang aman dan terkelola dengan baik</p>
                <button class="btn btn-disabled mt-2" disabled>Belum Tersedia</button>
            </div>

            <div class="service-card animate-item disabled">
                <div class="coming-soon-badge">Segera Hadir</div>
                <div class="service-icon">
                    <i class="bi bi-hdd-stack"></i>
                </div>
                <h4>VPS</h4>
                <p>Virtual Private Server untuk kebutuhan hosting, development, dan aplikasi khusus</p>
                <button class="btn btn-disabled mt-2" disabled>Belum Tersedia</button>
            </div>

            <div class="service-card animate-item disabled">
                <div class="coming-soon-badge">Segera Hadir</div>
                <div class="service-icon">
                    <i class="bi bi-envelope"></i>
                </div>
                <h4>Email</h4>
                <p>Layanan email profesional dengan domain instansi dan kapasitas penyimpanan yang memadai</p>
                <button class="btn btn-disabled mt-2" disabled>Belum Tersedia</button>
            </div>

            <div class="service-card animate-item disabled">
                <div class="coming-soon-badge">Segera Hadir</div>
                <div class="service-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h4>VPN</h4>
                <p>Virtual Private Network untuk akses aman ke jaringan internal dari lokasi remote</p>
                <button class="btn btn-disabled mt-2" disabled>Belum Tersedia</button>
            </div>
            <div class="service-card animate-item disabled">
                <div class="coming-soon-badge">Segera Hadir</div>
                <div class="service-icon">
                    <i class="bi bi-ethernet"></i>
                </div>
                <h4>Port Permission</h4>
                <p>Pengaturan izin akses port untuk layanan jaringan internal</p>
                <button class="btn btn-disabled mt-2" disabled>Belum Tersedia</button>
            </div>
        </div>

        <!-- Stats Section -->
        <h2 class="section-title animate-item">Statistik Laporan Saya</h2>
        <div class="row">
            <div class="col-md-4 animate-item">
                <div class="stats-card">
                    <div class="stats-icon text-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <h2><span id="completed-count">{{ $stats['completed'] ?? 0 }}</span></h2>
                    <p>Laporan Selesai</p>
                </div>
            </div>
            <div class="col-md-4 animate-item">
                <div class="stats-card">
                    <div class="stats-icon text-warning">
                        <i class="bi bi-arrow-clockwise"></i>
                    </div>
                    <h2><span id="progress-count">{{ $stats['progress'] ?? 0 }}</span></h2>
                    <p>Dalam Proses</p>
                </div>
            </div>
            <div class="col-md-4 animate-item">
                <div class="stats-card">
                    <div class="stats-icon text-primary">
                        <i class="bi bi-plus-circle"></i>
                    </div>
                    <h2><span id="total-count">{{ $stats['total'] ?? 0 }}</span></h2>
                    <p>Total Laporan</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer animate-item">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-md-start">
                        <h5 class="mb-2">Sistem Laporan TIK</h5>
                        <p class="mb-0">Portal untuk pelaporan masalah Teknologi Informasi dan Komunikasi</p>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        <p class="mb-1">&copy; 2025 Diskominsa Aceh TIK</p>
                        <p class="mb-0 text-muted">Version 2.1.0</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Modal Relokasi -->
    <div class="modal fade" id="relokasiModal" tabindex="-1" aria-labelledby="relokasiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="relokasiModalLabel">
                        <i class="fas fa-exchange-alt me-2"></i>Formulir Relokasi Layanan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('relokasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Data Pemohon -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_pemohon" class="form-label">Nama Pemohon</label>
                                    <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" value="{{ Auth::guard('guest')->user()->nama_pelapor }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" class="form-control" id="nip" name="nip" value="{{ Auth::guard('guest')->user()->nip }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="instansi" class="form-label">Instansi</label>
                            <input type="text" class="form-control" id="instansi" name="instansi" value="{{ Auth::guard('guest')->user()->instansi }}" required>
                        </div>

                        <!-- Jenis Relokasi -->
                        <div class="mb-3">
                            <label for="jenis_relokasi" class="form-label">Jenis Relokasi</label>
                            <select class="form-select" id="jenis_relokasi" name="jenis_relokasi" required>
                                <option value="">Pilih Jenis Relokasi</option>
                                <option value="jaringan">Jaringan</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <!-- Jika memilih jaringan, tampilkan field ini -->
                        <div id="jaringan_fields" style="display: none;">
                            <div class="mb-3">
                                <label for="nama_alat_jaringan" class="form-label">Nama Alat Jaringan</label>
                                <input type="text" class="form-control" id="nama_alat_jaringan" name="nama_alat_jaringan">
                            </div>
                            <div class="mb-3">
                                <label for="ip_address" class="form-label">IP Address</label>
                                <input type="text" class="form-control" id="ip_address" name="ip_address" placeholder="Contoh: 192.168.1.1">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan tambahan mengenai relokasi"></textarea>
                        </div>

                        <!-- Lokasi Awal -->
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="border-bottom pb-2">Lokasi Awal</h6>
                                <div class="mb-3">
                                    <label for="instansi_awal" class="form-label">Nama Tempat/Instansi Awal</label>
                                    <input type="text" class="form-control" id="instansi_awal" name="instansi_awal" required>
                                </div>
                                <div class="mb-3">
                                    <label for="koordinat_awal" class="form-label">Koordinat Lokasi Awal</label>
                                    <input type="text" class="form-control" id="koordinat_awal" name="koordinat_awal" placeholder="Contoh: -6.2088, 106.8456" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="border-bottom pb-2">Lokasi Tujuan</h6>
                                <div class="mb-3">
                                    <label for="instansi_tujuan" class="form-label">Nama Tempat/Instansi Tujuan</label>
                                    <input type="text" class="form-control" id="instansi_tujuan" name="instansi_tujuan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="koordinat_tujuan" class="form-label">Koordinat Lokasi Tujuan</label>
                                    <input type="text" class="form-control" id="koordinat_tujuan" name="koordinat_tujuan" placeholder="Contoh: -6.2088, 106.8456" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="surat_bukti_izin_relokasi" class="form-label">Upload Surat Bukti Izin Relokasi (PDF)</label>
                            <input type="file" class="form-control" id="surat_bukti_izin_relokasi" name="surat_bukti_izin_relokasi" accept=".pdf" required>
                            <div class="form-text">Maksimal ukuran file: 2MB</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ajukan Relokasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');

            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 992 &&
                    sidebar &&
                    !sidebar.contains(event.target) &&
                    !sidebarToggle.contains(event.target) &&
                    sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            });

            // Handle jenis relokasi dropdown
            document.getElementById('jenis_relokasi').addEventListener('change', function() {
                var jaringanFields = document.getElementById('jaringan_fields');
                if (this.value === 'jaringan') {
                    jaringanFields.style.display = 'block';
                    document.getElementById('nama_alat_jaringan').setAttribute('required', 'required');
                    document.getElementById('ip_address').setAttribute('required', 'required');
                } else {
                    jaringanFields.style.display = 'none';
                    document.getElementById('nama_alat_jaringan').removeAttribute('required');
                    document.getElementById('ip_address').removeAttribute('required');
                }
            });

            // Animations
            anime({
                targets: '.animate-item',
                translateY: 0,
                opacity: 1,
                delay: anime.stagger(100),
                duration: 800,
                easing: 'easeOutQuart'
            });

            const serviceCards = document.querySelectorAll('.service-card');
            serviceCards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    if (!card.classList.contains('disabled')) {
                        anime({
                            targets: card,
                            scale: 1.02,
                            duration: 300,
                            easing: 'easeInOutQuad'
                        });
                    }
                });

                card.addEventListener('mouseleave', () => {
                    if (!card.classList.contains('disabled')) {
                        anime({
                            targets: card,
                            scale: 1,
                            duration: 300,
                            easing: 'easeInOutQuad'
                        });
                    }
                });
            });

            anime({
                targets: '.welcome-section',
                translateY: [50, 0],
                opacity: [0, 1],
                duration: 1000,
                easing: 'easeOutQuart'
            });

            anime({
                targets: '.stats-card',
                translateY: [30, 0],
                opacity: [0, 1],
                delay: anime.stagger(200),
                duration: 800,
                easing: 'easeOutQuart'
            });

            // Animasi angka statistik (counting animation)
            const statsData = {
                completed: {{ $stats['completed'] ?? 0 }},
                progress: {{ $stats['progress'] ?? 0 }},
                total: {{ $stats['total'] ?? 0 }}
            };

            const counters = [
                { element: document.getElementById('completed-count'), value: statsData.completed },
                { element: document.getElementById('progress-count'), value: statsData.progress },
                { element: document.getElementById('total-count'), value: statsData.total }
            ];

            counters.forEach(counter => {
                anime({
                    targets: { count: 0 },
                    count: counter.value,
                    round: 1,
                    easing: 'easeInOutQuad',
                    duration: 2000,
                    update: function(anim) {
                        counter.element.textContent = anim.animatables[0].target.count;
                    }
                });
            });

            // Auto-dismiss alert
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.classList.remove('show');
                    setTimeout(() => alert.remove(), 150);
                }, 5000);
            }
        });
    </script>
</body>
</html>
