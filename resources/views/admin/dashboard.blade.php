<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-right: 30px;
        }
        .main-content {
            padding: 20px;

        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            transition: transform 0.3s ease;
            border: none;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
        }
        .status-pending {
            background-color: #4e73df;
            color: white;
        }
        .status-on-progress {
            background-color: #f6c23e;
            color: #1a202c;
        }
        .status-complete {
            background-color: #1cc88a;
            color: white;
        }
        .status-total {
            background-color: #6f42c1;
            color: white;
        }
        .table th {
            background-color: #f8f9fc;
            color: #4e73df;
            font-weight: 700;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }
        .badge-status {
            padding: 0.5em 0.75em;
            border-radius: 20px;
            font-weight: 600;
        }
        .section-title {
            border-left: 4px solid #4e73df;
            padding-left: 12px;
            margin: 25px 0 15px;
            color: #2e3a59;
        }
    </style>
</head>
<body>
<div class="container-fluid ">
    <div class="row">

        @include('components.sidebar')

        <main class="col-md-9 col-lg-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold capitalize">Dashboard {{ Auth::user()->role }}</h1>
                <div class="d-flex align-items-center">
                    <span class="me-3">Hi, {{ Auth::user()->name }}</span>
                    <div class="avatar bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                        <i class="fas fa-user text-white"></i>
                    </div>
                </div>
            </div>

            <!-- Alert -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card h-100 status-total">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">TOTAL</h5>
                                    <p class="stat-number">{{ $totalLaporan }}</p>
                                </div>
                                <div class="display-4">
                                    <i class="fas fa-database"></i>
                                </div>
                            </div>
                            <p class="mb-0">Semua laporan masuk</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 status-pending">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">PENDING</h5>
                                    <p class="stat-number">{{ $pending }}</p>
                                </div>
                                <div class="display-4">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <p class="mb-0">Menunggu penanganan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 status-on-progress">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">PROSES</h5>
                                    <p class="stat-number">{{ $on_progress }}</p>
                                </div>
                                <div class="display-4">
                                    <i class="fas fa-tasks"></i>
                                </div>
                            </div>
                            <p class="mb-0">Sedang ditangani</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 status-complete">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">SELESAI</h5>
                                    <p class="stat-number">{{ $complete }}</p>
                                </div>
                                <div class="display-4">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                            <p class="mb-0">Telah diselesaikan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="fw-bold m-0"><i class="fas fa-chart-bar me-2"></i>Distribusi Laporan</h5>
                </div>
                <div class="card-body">
                    <canvas id="statusChart" height="120"></canvas>
                </div>
            </div>

            <!-- Recent Reports -->
            <div class="card mt-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold m-0"><i class="fas fa-list me-2"></i>Daftar Laporan Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Instansi</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal Laporan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($recentReports as $report)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $report->instansi }}</td>
                                    <td>{{ $report->kategori->nama_kategori }}</td>
                                    <td>
                                        <span class="badge-status status-{{ str_replace(' ', '-', strtolower($report->status)) }}">
                                            {{ $report->status }}
                                        </span>
                                    </td>
                                    <td>{{ $report->created_at->format('d/m/Y ') }}</td>
                                </tr>
                            @endforeach
                            @if($recentReports->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fas fa-inbox fa-2x mb-3 text-muted"></i>
                                        <p class="text-muted">Tidak ada data laporan</p>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pending', 'Dalam Proses', 'Selesai'],
                datasets: [{
                    label: 'Jumlah Laporan',
                    data: [{{ $pending }}, {{ $on_progress }}, {{ $complete }}],
                    backgroundColor: ['#4e73df', '#f6c23e', '#1cc88a'],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    });
</script>
</body>
</html>
