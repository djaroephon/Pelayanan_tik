<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Relokasi #{{ $relokasi->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #6c757d;
            --success: #1cc88a;
            --warning: #f6c23e;
            --danger: #dc3545;
            --info: #36b9cc;
            --light: #f8f9fc;
            --dark: #2e3a59;
            --sidebar-width: 280px;
        }

        body {
            background: linear-gradient(135deg, #f8f9fc 0%, #e9ecef 100%);
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 15px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 10px;
            }
        }

        /* Header Styles - More Compact */
        .page-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.1);
            margin-bottom: 1.25rem;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), #3a56d4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            box-shadow: 0 3px 8px rgba(67, 97, 238, 0.3);
        }

        /* Card Styles - More Compact */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(58, 59, 69, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 1.25rem;
            overflow: hidden;
            background: white;
        }

        .card-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(58, 59, 69, 0.12);
        }

        .card-header-custom {
            background: linear-gradient(135deg, #f8f9fc, #e9ecef);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            font-size: 1.1rem;
        }

        .card-header-custom i {
            color: var(--primary);
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        /* Form Styles - More Compact */
        .form-section {
            background: rgba(248, 249, 252, 0.6);
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 1.25rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .form-section:hover {
            background: rgba(248, 249, 252, 0.8);
            transform: translateY(-1px);
        }

        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(67, 97, 238, 0.1);
            display: flex;
            align-items: center;
            font-size: 1rem;
        }

        .section-title i {
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.4rem;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 0.6rem 0.8rem;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            font-size: 0.9rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.15);
            transform: translateY(-1px);
        }

        .form-control:read-only {
            background-color: #f8f9fa;
            color: #6c757d;
            cursor: not-allowed;
        }

        /* Button Styles - More Compact */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #3a56d4);
            border: none;
            border-radius: 8px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(67, 97, 238, 0.3);
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.4);
            background: linear-gradient(135deg, #3a56d4, #2f48a8);
        }

        .btn-outline-primary {
            border: 1px solid var(--primary);
            border-radius: 6px;
            color: var(--primary);
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(67, 97, 238, 0.3);
        }

        /* Badge Styles - More Compact */
        .badge-custom {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(58, 86, 212, 0.1));
            border: 1px solid rgba(67, 97, 238, 0.2);
            border-radius: 15px;
            padding: 0.4rem 0.8rem;
            font-weight: 600;
            color: var(--primary);
            backdrop-filter: blur(10px);
            font-size: 0.8rem;
        }

        /* Divider */
        .divider-custom {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(67, 97, 238, 0.3), transparent);
            margin: 1.5rem 0;
            border: none;
        }

        /* Location Sections - More Compact */
        .location-section {
            background: white;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.8rem;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .location-section:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .location-section h6 {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .location-section h6 i {
            margin-right: 0.4rem;
            font-size: 0.8rem;
        }

        /* Status Badge Colors */
        .status-pending { background: linear-gradient(135deg, #f6c23e, #e0a800); color: #2e3a59; }
        .status-progress { background: linear-gradient(135deg, #36b9cc, #2a96a5); color: white; }
        .status-completed { background: linear-gradient(135deg, #1cc88a, #17a673); color: white; }
        .status-cancelled { background: linear-gradient(135deg, #dc3545, #c82333); color: white; }

        /* Animation - Faster */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-15px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.4s ease-out;
        }

        .slide-in-left {
            animation: slideInLeft 0.4s ease-out;
        }

        /* Custom spacing */
        .form-group-spacing {
            margin-bottom: 1rem;
        }

        .readonly-field {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef) !important;
            border-color: #e2e8f0 !important;
        }

        /* Select styling */
        .form-select option {
            padding: 8px;
        }

        /* Grid adjustments for better spacing */
        .row.g-3 {
            --bs-gutter-x: 0.75rem;
            --bs-gutter-y: 0.75rem;
        }

        .row.g-4 {
            --bs-gutter-x: 1rem;
            --bs-gutter-y: 1rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .main-content {
                padding: 8px;
            }

            .page-header {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .form-section {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .card-header-custom {
                padding: 0.8rem 1rem;
            }

            .location-section {
                padding: 0.8rem;
            }

            .section-title {
                font-size: 0.95rem;
            }

            .form-label {
                font-size: 0.85rem;
            }

            .form-control, .form-select {
                padding: 0.5rem 0.7rem;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            .page-header h1 {
                font-size: 1.25rem;
            }

            .card-header-custom {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar Component -->
            @include('components.sidebar')

            <!-- Main Content -->
            <main class="main-content">
                <!-- Header -->
                <div class="page-header fade-in-up">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <h1 class="h4 fw-bold mb-0"><i class="fas fa-exchange-alt me-2"></i>Kelola Relokasi #{{ $relokasi->id }}</h1>
                            <p class="text-muted mb-0 mt-1 small">Kelola proses relokasi perangkat jaringan</p>
                        </div>
                        <div class="col-md-5 text-md-end">
                            <div class="d-flex align-items-center justify-content-end">
                                <span class="badge-custom me-2">
                                    <i class="fas fa-info-circle me-1"></i> ID: {{ $relokasi->id }}
                                </span>
                                <span class="me-2 fw-medium small">Hi, {{ Auth::user()->name }}</span>
                                <div class="user-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Card -->
                <div class="card card-custom fade-in-up" style="animation-delay: 0.1s">
                    <div class="card-header card-header-custom">
                        <i class="fas fa-edit me-2"></i>Edit Relokasi
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.relokasi.update', $relokasi->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Informasi Pemohon -->
                            <div class="form-section slide-in-left" style="animation-delay: 0.2s">
                                <h5 class="section-title"><i class="fas fa-user-circle"></i>Informasi Pemohon</h5>
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Pemohon</label>
                                        <input type="text" class="form-control readonly-field" value="{{ $relokasi->nama_pemohon }}" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">NIP</label>
                                        <input type="text" class="form-control readonly-field" value="{{ $relokasi->nip }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Instansi</label>
                                        <input type="text" class="form-control readonly-field" value="{{ $relokasi->instansi }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Relokasi -->
                            <div class="form-section slide-in-left" style="animation-delay: 0.3s">
                                <h5 class="section-title"><i class="fas fa-file-alt"></i>Detail Relokasi</h5>

                                <div class="row g-2 form-group-spacing">
                                    <div class="col-md-2">
                                        <label class="form-label">Jenis Relokasi</label>
                                        <input type="text" class="form-control readonly-field" value="{{ ucfirst($relokasi->jenis_relokasi) }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Alat Jaringan</label>
                                        <input type="text" class="form-control readonly-field" value="{{ $relokasi->nama_alat_jaringan ?? '-' }}" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">IP Address</label>
                                        <input type="text" class="form-control readonly-field" value="{{ $relokasi->ip_address ?? '-' }}" readonly>
                                    </div>
                                </div>

                                <div class="row g-2 form-group-spacing">
                                    <div class="col-10">
                                        <label class="form-label">Keterangan</label>
                                        <textarea class="form-control readonly-field" rows="2" readonly>{{ $relokasi->keterangan ?? '-' }}</textarea>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-5">
                                        <div class="location-section">
                                            <h6><i class="fas fa-map-marker-alt"></i>Lokasi Awal</h6>
                                            <div class="mb-2">
                                                <label class="form-label">Instansi Awal</label>
                                                <input type="text" class="form-control readonly-field" value="{{ $relokasi->instansi_awal }}" readonly>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Koordinat Awal</label>
                                                <input type="text" class="form-control readonly-field" value="{{ $relokasi->koordinat_awal }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="location-section">
                                            <h6><i class="fas fa-flag-checkered"></i>Lokasi Tujuan</h6>
                                            <div class="mb-2">
                                                <label class="form-label">Instansi Tujuan</label>
                                                <input type="text" class="form-control readonly-field" value="{{ $relokasi->instansi_tujuan }}" readonly>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Koordinat Tujuan</label>
                                                <input type="text" class="form-control readonly-field" value="{{ $relokasi->koordinat_tujuan }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">Surat Bukti Izin Relokasi</label>
                                    <div>
                                        <a href="{{ asset('storage/relokasi/' . $relokasi->surat_bukti_izin_relokasi) }}" target="_blank" class="btn btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i> Lihat Surat
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="divider-custom"></div>

                            <!-- Penanganan Relokasi -->
                            <div class="form-section slide-in-left" style="animation-delay: 0.4s">
                                <h5 class="section-title"><i class="fas fa-tools"></i>Penanganan Relokasi</h5>
                                <div class="row g-2 form-group-spacing">
                                    <div class="col-md-2">
                                        <label class="form-label">Status Relokasi</label>
                                        <select name="status" class="form-select" required>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status }}" {{ $relokasi->status == $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Teknisi</label>
                                        <select name="teknisi_id" class="form-select">
                                            <option value="">Pilih Teknisi</option>
                                            @foreach($teknisis as $teknisi)
                                                <option value="{{ $teknisi->id }}" {{ $relokasi->teknisi_id == $teknisi->id ? 'selected' : '' }}>
                                                    {{ $teknisi->nama_teknisi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Penjab Layanan</label>
                                        <select name="penjab_id" class="form-select" required>
                                            <option value="">Pilih Penjab</option>
                                            @foreach($penjabs as $penjab)
                                                <option value="{{ $penjab->id }}"
                                                    {{ optional($relokasi->penjab)->id == $penjab->id ? 'selected' : '' }}>
                                                    {{ $penjab->nama_penjab_layanan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group-spacing col-md-10">
                                    <label class="form-label">Keterangan Admin</label>
                                    <textarea name="keterangan_admin" class="form-control" rows="3" placeholder="Masukkan keterangan dari admin...">{{ $relokasi->keterangan_admin }}</textarea>
                                </div>
                            </div>

                            <div class="" style="animation-delay: 0.5s">
                                <button type="submit" class="btn btn-primary px-3">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation to form elements
            const formElements = document.querySelectorAll('.form-control, .form-select');
            formElements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.03}s`;
                element.classList.add('slide-in-left');
            });

            // Add status color to current status
            const statusSelect = document.querySelector('select[name="status"]');
            function updateStatusColor() {
                const selectedOption = statusSelect.options[statusSelect.selectedIndex];
                statusSelect.className = 'form-select';

                if (selectedOption.value === 'pending') {
                    statusSelect.classList.add('status-pending');
                } else if (selectedOption.value === 'in_progress') {
                    statusSelect.classList.add('status-progress');
                } else if (selectedOption.value === 'completed') {
                    statusSelect.classList.add('status-completed');
                } else if (selectedOption.value === 'cancelled') {
                    statusSelect.classList.add('status-cancelled');
                }
            }

            // Initial color update
            updateStatusColor();

            // Update color on change
            statusSelect.addEventListener('change', updateStatusColor);
        });
    </script>
</body>
</html>
