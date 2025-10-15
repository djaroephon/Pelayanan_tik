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
        :root {
            --primary: #4361ee;
            --secondary: #6c757d;
            --success: #1cc88a;
            --warning: #f6c23e;
            --info: #36b9cc;
            --dark: #2e3a59;
            --light: #f8f9fc;
            --sidebar-width: 280px;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
            }
        }

        /* Header Styles */
        .dashboard-header {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.25rem;
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
            font-size: 1.1rem;
        }

        /* Card Styles */
        .stat-card {
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            transition: all 0.3s ease;
            border: none;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.4rem 1.5rem 0 rgba(58, 59, 69, 0.15);
        }

        .stat-card .card-body {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.4rem;
        }

        .stat-number {
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .stat-icon {
            font-size: 2rem;
            opacity: 0.8;
        }

        .card-footer {
            background: rgba(0, 0, 0, 0.03);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 0.6rem 1.25rem;
            font-size: 0.8rem;
        }

        /* Status Colors */
        .status-total {
            background: linear-gradient(135deg, #6f42c1, #5a32a3);
            color: white;
        }

        .status-pending {
            background: linear-gradient(135deg, #4e73df, #3a56d4);
            color: white;
        }

        .status-on-progress {
            background: linear-gradient(135deg, #f6c23e, #e0a800);
            color: #2e3a59;
        }

        .status-complete {
            background: linear-gradient(135deg, #1cc88a, #17a673);
            color: white;
        }

        /* Chart Card - Smaller */
        .chart-card {
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            border: none;
            margin-bottom: 1.25rem;
        }

        .chart-card .card-header {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.95rem;
        }

        .chart-card .card-body {
            padding: 1.25rem;
        }

        /* Table Styles - Smaller */
        .table-card {
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            border: none;
        }

        .table-card .card-header {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.95rem;
        }

        .table th {
            background-color: #f8f9fc;
            color: var(--primary);
            font-weight: 600;
            border-top: none;
            padding: 0.75rem 0.6rem;
            font-size: 0.85rem;
        }

        .table td {
            padding: 0.75rem 0.6rem;
            vertical-align: middle;
            font-size: 0.875rem;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .badge-status {
            padding: 0.4em 0.6em;
            border-radius: 16px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .status-pending-badge {
            background-color: rgba(78, 115, 223, 0.1);
            color: #4e73df;
        }

        .status-on-progress-badge {
            background-color: rgba(246, 194, 62, 0.1);
            color: #f6c23e;
        }

        .status-complete-badge {
            background-color: rgba(28, 200, 138, 0.1);
            color: #1cc88a;
        }

        /* Alert Styles */
        .alert {
            border-radius: 8px;
            border: none;
            box-shadow: 0 0.15rem 1rem 0 rgba(58, 59, 69, 0.1);
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }

        /* Empty State */
        .empty-state {
            padding: 2rem 1rem;
            text-align: center;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
            opacity: 0.5;
        }

        /* Smaller chart canvas */
        .chart-container {
            height: 200px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .stat-icon {
                font-size: 1.75rem;
            }

            .dashboard-header {
                padding: 1rem;
            }

            .chart-container {
                height: 180px;
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
            <div class="dashboard-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="h4 fw-bold mb-0 capitalize">Dashboard {{ Auth::user()->role }}</h1>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="d-flex align-items-center justify-content-end">
                            <span class="me-3 fw-medium">Hi, {{ Auth::user()->name }}</span>
                            <div class="user-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="row g-3 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card status-total h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">TOTAL LAPORAN</h5>
                                    <p class="stat-number">{{ $totalLaporan }}</p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-database stat-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <i class="fas fa-info-circle me-1"></i> Semua laporan masuk
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card status-on-progress h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">DALAM PROSES</h5>
                                    <p class="stat-number">{{ $on_progress }}</p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tasks stat-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <i class="fas fa-info-circle me-1"></i> Sedang ditangani
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card status-complete h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">SELESAI</h5>
                                    <p class="stat-number">{{ $complete }}</p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle stat-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <i class="fas fa-info-circle me-1"></i> Telah diselesaikan
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart and Table in a row -->
            <div class="row g-3">
                <!-- Chart - Smaller -->
                <div class="col-lg-10">
                    <div class="card chart-card h-100">
                        <div class="card-header d-flex align-items-center">
                            <i class="fas fa-chart-bar me-2 text-primary"></i>
                            <span>Distribusi Laporan</span>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="statusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Reports - Smaller -->
                <div class="col-lg-10">
                    <div class="card table-card h-100">
                        <div class="card-header d-flex align-items-center">
                            <i class="fas fa-list me-2 text-primary"></i>
                            <span>Laporan Terbaru</span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive" style="max-height: 260px; overflow-y: auto;">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th width="8%">#</th>
                                        <th width="30%">Instansi</th>
                                        <th width="25%">Kategori</th>
                                        <th width="22%">Status</th>
                                        <th width="15%">Tanggal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($recentReports as $report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="fw-medium text-truncate" style="max-width: 120px;" title="{{ $report->instansi }}">{{ $report->instansi }}</td>
                                            <td class="text-truncate" style="max-width: 100px;" title="{{ $report->kategori->nama_kategori }}">{{ $report->kategori->nama_kategori }}</td>
                                            <td>
                                                @if($report->status == 'Pending')
                                                    <span class="badge-status status-pending-badge">
                                                        <i class="fas fa-clock me-1"></i> {{ $report->status }}
                                                    </span>
                                                @elseif($report->status == 'Dalam Proses')
                                                    <span class="badge-status status-on-progress-badge">
                                                        <i class="fas fa-tasks me-1"></i> {{ $report->status }}
                                                    </span>
                                                @else
                                                    <span class="badge-status status-complete-badge">
                                                        <i class="fas fa-check-circle me-1"></i> {{ $report->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="small">{{ $report->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                    @if($recentReports->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="fas fa-inbox"></i>
                                                    <p class="mb-0 small">Tidak ada data laporan</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                    backgroundColor: [
                        'rgba(78, 115, 223, 0.8)',
                        'rgba(246, 194, 62, 0.8)',
                        'rgba(28, 200, 138, 0.8)'
                    ],
                    borderColor: [
                        'rgb(78, 115, 223)',
                        'rgb(246, 194, 62)',
                        'rgb(28, 200, 138)'
                    ],
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#2e3a59',
                        bodyColor: '#2e3a59',
                        borderColor: '#e3e6f0',
                        borderWidth: 1,
                        padding: 10,
                        boxPadding: 5,
                        titleFont: {
                            size: 12
                        },
                        bodyFont: {
                            size: 12
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0,
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    });
</script>
</body>
</html>
