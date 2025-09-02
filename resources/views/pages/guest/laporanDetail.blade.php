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
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
.status-completed {
    background-color: #d4edda;
    color: #155724;
}

.status-process {
    background-color: #fff3cd;
    color: #856404;
}

.status-pending {
    background-color: #f8d7da;
    color: #721c24;
}
        .main-content {
            padding: 20px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }

        .alert {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 20px;
        }

        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            overflow: hidden;
        }

        .table-title {
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--accent-color);
            display: flex;
            align-items: center;
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 0;
        }

        .table th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            padding: 12px 15px;
            text-align: left;
            position: sticky;
            top: 0;
        }

        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .table tr {
            transition: all 0.3s ease;
        }

        .table tr:hover {
            background-color: rgba(28, 144, 141, 0.05);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            text-align: center;
            min-width: 90px;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-process {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .animate-item {
            opacity: 0;
            transform: translateY(20px);
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
            display: none;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #dee2e6;
        }

        .action-btn {
            padding: 5px 10px;
            font-size: 0.875rem;
            border-radius: 4px;
        }

        /* Desktop styles */
        @media (min-width: 993px) {
            .main-content {
                margin-left: 280px;
            }
        }

        /* Tablet & Mobile styles */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding-top: 70px;
            }
        }

        /* Mobile kecil */
        @media (max-width: 576px) {
            .table-container {
                padding: 15px;
            }

            .table th, .table td {
                padding: 8px 10px;
                font-size: 0.9rem;
            }

            .table-title {
                font-size: 1.25rem;
            }

            .status-badge {
                min-width: 70px;
                padding: 4px 8px;
            }
        }

        /* Responsif untuk tabel */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table th:nth-child(1),
            .table td:nth-child(1) {
                min-width: 100px;
            }

            .table th:nth-child(2),
            .table td:nth-child(2) {
                min-width: 120px;
            }

            .table th:nth-child(3),
            .table td:nth-child(3) {
                min-width: 180px;
            }

            .table th:nth-child(4),
            .table td:nth-child(4) {
                min-width: 100px;
            }

            .table th:nth-child(5),
            .table td:nth-child(5) {
                min-width: 110px;
            }
        }
    </style>
</head>
<body>
    @include('components.sideGuest')
    <div class="main-content" id="mainContent">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-container animate-item">
            <h3 class="table-title"><i class="bi bi-list-check me-2"></i>Daftar Laporan Saya</h3>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Layanan</th>
                            <th>Permasalahan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->kategori->nama_kategori }}</td>
                                <td>{{ $item->laporan_permasalahan }}</td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                               <td>
    @if ($item->status === 'complete')
        <i class="bi bi-check-circle-fill text-success me-1"></i>
        <span class="status-badge status-completed">
            Selesai
        </span>
    @elseif ($item->status === 'process')
        <i class="bi bi-hourglass-split text-warning me-1"></i>
        <span class="status-badge status-process">
            Diproses
        </span>
    @elseif ($item->status === 'pending')
        <i class="bi bi-hourglass-top text-secondary me-1"></i>
        <span class="status-badge status-pending">
            Menunggu
        </span>
    @else
        <i class="bi bi-question-circle text-info me-1"></i>
        <span class="status-badge">
            {{ ucfirst($item->status) }}
        </span>
    @endif
</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="empty-state animate-item" id="emptyState">
                <i class="bi bi-inbox"></i>
                <h4>Belum ada laporan</h4>
                <p>Anda belum membuat laporan permintaan layanan TIK.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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

            anime({
                targets: 'tbody tr',
                translateX: [20, 0],
                opacity: [0, 1],
                delay: anime.stagger(100),
                duration: 600,
                easing: 'easeOutQuad'
            });

            const tableRows = document.querySelectorAll('tbody tr');
            const emptyState = document.getElementById('emptyState');

            if (tableRows.length === 0) {
                emptyState.style.display = 'block';
            }
        });
    </script>
</body>
</html>
