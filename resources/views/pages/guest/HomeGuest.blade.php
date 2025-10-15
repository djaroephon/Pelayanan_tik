<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Guest - Sistem Laporan TIK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
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

        /* Main Content Styles */
        .main-content {
            margin-left: 280px;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .welcome-section {
            background: linear-gradient(120deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .service-card {
            background-color: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        /* Footer Styles */
        .footer {
            background-color: white;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #eee;
            margin-top: 40px;
        }

        /* Animations */
        .animate-item {
            opacity: 0;
            transform: translateY(20px);
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
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 1.2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        /* Stats Cards */
        .stats-card {
            text-align: center;
            padding: 20px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .stats-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .services-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 992px) {


            .main-content {
                margin-left: 0;
                padding: 70px 15px 15px;
            }

            .welcome-section {
                padding: 20px;
                margin-top: 10px;
            }
        }

        @media (max-width: 768px) {
            .services-grid {
                grid-template-columns: 1fr;
            }

            .stats-card {
                margin-bottom: 15px;
            }

            .welcome-section h1 {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 576px) {
            .welcome-section .lead {
                font-size: 1rem;
            }

            .service-card {
                padding: 20px 15px;
            }

            .footer {
                padding: 15px;
            }

            .mobile-toggle {
                top: 15px;
                left: 15px;
                padding: 8px 12px;
            }
        }
    </style>
</head>
<body>
    @include('components.sideGuest')

    <div class="main-content" id="mainContent">
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
        <div class="welcome-section animate-item">
            <h1>Selamat Datang di Portal Guest</h1>
            <p class="lead">Sistem Laporan Masalah Teknologi Informasi dan Komunikasi</p>
        </div>

        <h2 class="mb-4 animate-item">Layanan Tersedia</h2>
        <div class="services-grid">
            <div class="service-card animate-item">
                <div class="service-icon">
                    <i class="bi bi-clipboard-plus"></i>
                </div>
                <h4>Buat Laporan Baru</h4>
                <p>Ajukan laporan permasalahan TIK yang Anda alami</p>
                <a href="/lapor" class="btn btn-primary mt-3">Ajukan Laporan</a>
            </div>

            <div class="service-card animate-item">
                <div class="service-icon">
                    <i class="bi bi-hdd-rack"></i>
                </div>
                <h4>Layanan Relocation</h4>
                <p>Permohonan Relocation</p>
<button type="button" class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#relokasiModal">
        Ajukan Relokasi
    </button>
        </div>
        <!-- Stats Section -->
        <h2 class="mb-4 mt-5 animate-item">Statistik Laporan Saya</h2>
        <div class="row">
            <div class="col-md-4 animate-item">
                <div class="stats-card">
                    <div class="stats-icon text-success">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <!-- Data dari database -->
                    <h2><span id="completed-count">{{ $stats['completed'] }}</span></h2>
                    <p>Laporan Selesai</p>
                </div>
            </div>
            <div class="col-md-4 animate-item">
                <div class="stats-card">
                    <div class="stats-icon text-warning">
                        <i class="bi bi-arrow-clockwise"></i>
                    </div>
                    <!-- Data dari database -->
                    <h2><span id="progress-count">{{ $stats['progress'] }}</span></h2>
                    <p>Dalam Proses</p>
                </div>
            </div>
            <div class="col-md-4 animate-item">
                <div class="stats-card">
                    <div class="stats-icon text-primary">
                        <i class="bi bi-plus-circle"></i>
                    </div>
                    <!-- Data dari database -->
                    <h2><span id="total-count">{{ $stats['total'] }}</span></h2>
                    <p>Total Laporan</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer animate-item">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-md-start">
                        <h5>Sistem Laporan TIK</h5>
                        <p>Portal untuk pelaporan masalah Teknologi Informasi dan Komunikasi</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p>&copy; 2025 Diskominsa Aceh TIK</p>
                        <p>Version 2.1.0</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

<div class="modal fade" id="relokasiModal" tabindex="-1" aria-labelledby="relokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="relokasiModalLabel">Formulir Relokasi Layanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <h6>Lokasi Awal</h6>
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
                            <h6>Lokasi Tujuan</h6>
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

        document.getElementById('jenis_relokasi').addEventListener('change', function() {
    var jaringanFields = document.getElementById('jaringan_fields');
    if (this.value === 'jaringan') {
        jaringanFields.style.display = 'block';
        // Set required untuk field jaringan
        document.getElementById('nama_alat_jaringan').setAttribute('required', 'required');
        document.getElementById('ip_address').setAttribute('required', 'required');
    } else {
        jaringanFields.style.display = 'none';
        // Hapus required
        document.getElementById('nama_alat_jaringan').removeAttribute('required');
        document.getElementById('ip_address').removeAttribute('required');
    }
});
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');

            sidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                sidebar.classList.toggle('active');
            });

            document.addEventListener('click', function(event) {
                if (window.innerWidth < 992 &&
                    !sidebar.contains(event.target) &&
                    !sidebarToggle.contains(event.target) &&
                    sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            });

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
                    anime({
                        targets: card,
                        scale: 1.02,
                        duration: 300,
                        easing: 'easeInOutQuad'
                    });
                });

                card.addEventListener('mouseleave', () => {
                    anime({
                        targets: card,
                        scale: 1,
                        duration: 300,
                        easing: 'easeInOutQuad'
                    });
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
        });


    </script>
</body>
</html>
