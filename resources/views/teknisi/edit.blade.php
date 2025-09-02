<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f5f7fa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .page-title {
            font-weight: 700;
            color: #4361ee;
            border-bottom: 3px solid #4361ee;
            display: inline-block;
            padding-bottom: 5px;
            margin-bottom: 1.5rem;
        }
        .card-header {
            background-color: #4361ee !important;
            color: #fff !important;
            font-weight: 600;
        }
        .detail-box {
            background: #fff;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .detail-box h5 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #343a40;
        }
        .form-group label {
            font-weight: 600;
            margin-top: 1rem;
        }
        .btn i {
            margin-right: .4rem;
        }
        .badge-status {
            font-size: .85rem;
            padding: .5em 1em;
            border-radius: 20px;
            font-weight: 600;
        }
        .status-pending { background: #f6c23e; color: #212529; }
        .status-proses { background: #4e73df; color: #fff; }
        .status-selesai { background: #1cc88a; color: #fff; }
    </style>
</head>
<body>

<div class="container py-4">
    <h1 class="page-title">Penyelesaian Laporan #{{ $laporan->id }}</h1>

    <!-- Detail laporan -->
    <div class="detail-box">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5><i class="fas fa-file-alt me-2 text-primary"></i> Detail Laporan</h5>
            <!-- Badge Status -->
            <span class="badge-status
                @if($laporan->status == 'Pending') status-pending
                @elseif($laporan->status == 'Proses') status-proses
                @elseif($laporan->status == 'Selesai') status-selesai
                @endif">
                {{ $laporan->status }}
            </span>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <p><strong>Pelapor:</strong> {{ $laporan->nama_pelapor }}</p>
                <p><strong>Instansi:</strong> {{ $laporan->instansi }}</p>
                <p><strong>Bidang:</strong> {{ $laporan->bidang }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Waktu Laporan:</strong> {{ \Carbon\Carbon::parse($laporan->waktu_laporan)->format('d M Y H:i') }}</p>
                <p><strong>IP Jaringan:</strong> {{ $laporan->ip_jaringan ?? '-' }}</p>
                <p><strong>IP Server:</strong> {{ $laporan->ip_server ?? '-' }}</p>
                <p><strong>Kategori:</strong> {{ $laporan->kategori->nama_kategori }}</p>
            </div>
        </div>
        <p class="mt-3"><strong>Permasalahan:</strong><br>
            {{ $laporan->laporan_permasalahan }}
        </p>
    </div>

    <!-- Form Penyelesaian -->
    <div class="card shadow border-0">
        <div class="card-header">
            <i class="fas fa-clipboard-check me-2"></i> Form Penyelesaian
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('teknisi.update', $laporan->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="deskripsi_masalah">Deskripsi Masalah</label>
                    <textarea class="form-control" id="deskripsi_masalah" name="deskripsi_masalah" rows="4" required
                              placeholder="Jelaskan permasalahan yang dihadapi..."></textarea>
                    <small class="form-text text-muted">Deskripsikan dengan jelas permasalahan yang terjadi.</small>
                </div>

                <div class="form-group">
                    <label for="deskripsi_penyelesaian">Deskripsi Penyelesaian</label>
                    <textarea class="form-control" id="deskripsi_penyelesaian" name="deskripsi_penyelesaian" rows="4" required
                              placeholder="Jelaskan langkah-langkah penyelesaian dan solusi akhir..."></textarea>
                    <small class="form-text text-muted">Tuliskan proses penanganan masalah secara rinci.</small>
                </div>

                <div class="mt-4 d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle"></i> Tandai Selesai
                    </button>
                    <a href="{{ route('teknisi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
