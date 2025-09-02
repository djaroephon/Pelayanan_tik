<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Laporan #{{ $laporan->id }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4361ee;
            --secondary: #6c757d;
            --success: #198754;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #212529;
            --sidebar-bg: #212529;
            --card-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
        }

        body {
            background-color: #f5f7fb;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .main-content {
            padding: 20px;
            transition: all 0.3s ease;
        }

        /* Header Styles */
        .page-header {
            background: linear-gradient(120deg, #4361ee, #3a56d4);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: var(--card-shadow);
        }

        .page-header h1 {
            font-weight: 600;
            margin: 0;
            font-size: 1.8rem;
        }

        /* Card Styles */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.12);
        }

        .card-header-custom {
            background: linear-gradient(120deg, #f8f9fc, #e9ecef);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 1.2rem 1.5rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 1.2rem;
        }

        /* Form Styles */
        .form-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            border-color: #4361ee;
        }

        .form-control[readonly] {
            background-color: #f8f9fc;
            color: #6c757d;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(120deg, #4361ee, #3a56d4);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
            background: linear-gradient(120deg, #3a56d4, #2f48a8);
        }

        /* Badge Styles */
        .badge {
            padding: 0.5em 0.8em;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.85em;
        }

        .badge-secondary {
            background: linear-gradient(120deg, #6c757d, #5a6268);
        }

        .badge-warning {
            background: linear-gradient(120deg, #ffc107, #e0a800);
            color: #1a202c;
        }

        .badge-success {
            background: linear-gradient(120deg, #198754, #0f6848);
        }

        .badge-danger {
            background: linear-gradient(120deg, #dc3545, #c82333);
        }

        .badge-primary {
            background: linear-gradient(120deg, #4361ee, #3a56d4);
        }

        /* Table Styles */
        .table-custom {
            margin: 0;
            width: 100% !important;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table-custom thead tr {
            background: linear-gradient(120deg, #4361ee, #3a56d4);
            color: white;
        }

        .table-custom thead th {
            border: none;
            padding: 1rem 1.2rem;
            font-weight: 600;
            font-size: 0.95rem;
            vertical-align: middle;
        }

        .table-custom tbody td {
            padding: 1rem 1.2rem;
            vertical-align: middle;
            border-color: #f1f1f1;
        }

        .table-custom tbody tr {
            transition: background-color 0.2s ease;
        }

        .table-custom tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        /* Select2 Customization */
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.375rem 0.75rem;
            min-height: calc(1.5em + 0.75rem + 2px);
            transition: all 0.3s ease;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            border-color: #4361ee;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: linear-gradient(120deg, #4361ee, #3a56d4);
            border: none;
            border-radius: 6px;
            color: white;
            padding: 0 0.5rem;
        }

        /* Divider */
        .divider-custom {
            border-top: 1px solid #e9ecef;
            margin: 2rem 0;
            position: relative;
        }

        .divider-custom:before {
            content: '';
            position: absolute;
            top: -5px;
            left: 0;
            right: 0;
            height: 10px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='10' viewBox='0 0 20 10'%3E%3Ccircle cx='5' cy='5' r='2' fill='%234361ee'/%3E%3Ccircle cx='10' cy='5' r='2' fill='%234361ee'/%3E%3Ccircle cx='15' cy='5' r='2' fill='%234361ee'/%3E%3C/svg%3E") center center repeat-x;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .page-header {
                padding: 1rem;
            }

            .page-header h1 {
                font-size: 1.5rem;
            }

            .form-section {
                padding: 1rem;
            }

            .table-custom thead th,
            .table-custom tbody td {
                padding: 0.75rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Header -->
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1><i class="fas fa-clipboard-list me-2"></i>Kelola Laporan #{{ $laporan->id }}</h1>
                        <span class="badge bg-light text-dark"><i class="fas fa-info-circle me-1"></i> ID: {{ $laporan->id }}</span>
                    </div>
                </div>

                <div class="card card-custom">
                    <div class="card-header card-header-custom">
                        <i class="fas fa-edit me-2"></i>Edit Laporan
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('laporan.update', $laporan->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Pelapor Section -->
                            <div class="form-section">
                                <h5 class="section-title"><i class="fas fa-user-circle"></i>Informasi Pelapor</h5>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Pelapor</label>
                                        <input type="text" class="form-control" value="{{ $laporan->nama_pelapor }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">No HP Pelapor</label>
                                        <input type="text" class="form-control" value="{{ $laporan->no_hp_pelapor }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Email Pelapor</label>
                                        <input type="text" class="form-control" value="{{ $laporan->email_pelapor }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Instansi</label>
                                        <input type="text" class="form-control" value="{{ $laporan->instansi }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Bidang</label>
                                        <input type="text" class="form-control" value="{{ $laporan->bidang }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- Laporan Section -->
                            <div class="form-section">
                                <h5 class="section-title"><i class="fas fa-file-alt"></i>Detail Laporan</h5>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Waktu Permasalahan</label>
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($laporan->waktu_permasalahan)->format('d M Y H:i') }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kategori</label>
                                        <input type="text" class="form-control" value="{{ $laporan->kategori->nama_kategori }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">IP Jaringan</label>
                                        <input type="text" class="form-control" value="{{ $laporan->ip_jaringan }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">IP Server</label>
                                        <input type="text" class="form-control" value="{{ $laporan->ip_server }}" readonly>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Permasalahan</label>
                                    <textarea class="form-control" rows="4" readonly>{{ $laporan->laporan_permasalahan }}</textarea>
                                </div>
                            </div>

                            <div class="divider-custom"></div>

                            <!-- Penanganan Section -->
                            <div class="form-section">
                                <h5 class="section-title"><i class="fas fa-tools"></i>Penanganan Laporan</h5>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Status Laporan</label>
                                        <select name="status" class="form-select" required>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status }}" {{ $laporan->status == $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Teknisi</label>
                                        <select name="teknisi_ids[]" class="form-select select2" multiple required>
                                            @foreach($teknisis as $teknisi)
                                                <option value="{{ $teknisi->id }}"
                                                    {{ $laporan->teknisis->contains($teknisi->id) ? 'selected' : '' }}>
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
                                                    {{ optional($laporan->penyelesaian)->penjab_layanan_id == $penjab->id ? 'selected' : '' }}>
                                                    {{ $penjab->nama_penjab_layanan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Penyelesaian Section -->
                <div class="card card-custom">
                    <div class="card-header card-header-custom">
                        <i class="fas fa-clipboard-check me-2"></i>Detail Penyelesaian
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-custom table-hover">
                                <thead>
                                    <tr>
                                        <th>Teknisi</th>
                                        <th>Deskripsi Masalah</th>
                                        <th>Deskripsi Penyelesaian</th>
                                        <th>Selesai Pada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($laporan->teknisis as $teknisi)
                                        <tr>
                                            <td class="fw-semibold">{{ $teknisi->nama_teknisi }}</td>
                                            <td>
                                                {{ $teknisi->pivot->deskripsi_masalah ?? 'Belum diisi' }}
                                            </td>
                                            <td>{{ $teknisi->pivot->deskripsi_penyelesaian ?? 'Belum diisi' }}</td>
                                            <td>
                                                @if($teknisi->pivot->selesai_pada)
                                                    <span class="badge badge-success">
                                                        {{ \Carbon\Carbon::parse($teknisi->pivot->selesai_pada)->format('d M Y H:i') }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-secondary">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <i class="fas fa-inbox fa-2x mb-3 text-muted"></i>
                                                <p class="text-muted">Belum ada penyelesaian</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                placeholder: "Pilih teknisi",
                allowClear: true,
                width: '100%'
            });

            // Add animation to table rows
            $('.table-custom tbody tr').each(function(i) {
                $(this).delay(i * 50).fadeIn(300);
            });
        });
    </script>
</body>
</html>
