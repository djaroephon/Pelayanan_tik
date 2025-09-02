<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun Guest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --border: #dee2e6;
            --shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 1rem 3rem rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: #f5f7fb;
            font-family: 'Poppins', sans-serif;
            color: #344767;
        }

        .content-wrapper {
            padding: 1.5rem;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 0.75rem;
            padding: 1.5rem;
            color: white;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .table-container {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
        }

        .table thead th {
            padding: 1rem 1.25rem;
            font-weight: 600;
            border: none;
        }

        .table tbody tr {
            transition: background-color 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .table tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-top: 1px solid var(--border);
        }

        .status-badge {
            padding: 0.4em 0.8em;
            font-size: 0.85em;
            font-weight: 500;
            border-radius: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-pending {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-approved {
            background-color: #198754;
            color: white;
        }

        .badge-rejected {
            background-color: #dc3545;
            color: white;
        }

        .action-buttons .btn {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .action-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-success {
            background: linear-gradient(to right, #198754, #157347);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(to right, #dc3545, #bb2d3b);
            border: none;
        }

        .btn-outline-primary {
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
        }

        .alert {
            border-radius: 0.75rem;
            box-shadow: var(--shadow);
            border: none;
        }

        .pagination .page-link {
            border-radius: 0.5rem;
            margin: 0 0.2rem;
            border: none;
            color: var(--primary);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border: none;
        }

        .empty-state {
            padding: 3rem;
            text-align: center;
            color: var(--gray);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #d1d7e0;
        }

        .search-box {
            max-width: 300px;
        }



        .pagination-info {
            background-color: #e9ecef;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .content-wrapper {
                padding: 1rem;
            }

            .table-responsive {
                border: none;
            }

            .action-buttons {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }

            .action-buttons .btn {
                width: 100%;
            }

            .pagination-container {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
           @include('components.sidebar')

            <!-- Content -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="content-wrapper">
                    <div class="page-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h2 mb-0"><i class="bi bi-people me-2"></i>Kelola Akun Guest</h1>
                                <p class="mb-0 opacity-75">Kelola permintaan akses guest ke sistem</p>
                            </div>
                            <div class="search-box">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari akun..." id="searchInput">
                                    <button class="btn btn-light" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <strong>{{ session('success') }}</strong>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-container">
                        @if(count($guests) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="guestTable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>NIP</th>
                                        <th>Instansi</th>
                                        <th>Status</th>
                                        <th>Dokumen</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($guests as $guest)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <span class="fw-semibold">{{ $guest->nama_pelapor }}</span>
                                                    <div class="text-muted small">{{ $guest->created_at->format('d M Y') }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $guest->nik }}</td>
                                        <td>{{ $guest->nip }}</td>
                                        <td>{{ $guest->instansi }}</td>
                                        <td>
                                            @if($guest->status === 'pending')
                                                <span class="badge status-badge badge-pending">
                                                    <i class="bi bi-clock me-1"></i> Menunggu
                                                </span>
                                            @elseif($guest->status === 'approved')
                                                <span class="badge status-badge badge-approved">
                                                    <i class="bi bi-check-circle me-1"></i> Disetujui
                                                </span>
                                            @else
                                                <span class="badge status-badge badge-rejected">
                                                    <i class="bi bi-x-circle me-1"></i> Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.documents.show', basename($guest->surat_pernyataan_pengelola)) }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-outline-primary d-flex align-items-center">
                                                    <i class="bi bi-file-earmark-pdf me-1"></i> Surat
                                                </a>
                                                <a href="{{ route('admin.ktp.show', basename($guest->ktp)) }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-outline-primary d-flex align-items-center">
                                                    <i class="bi bi-person-badge me-1"></i> KTP
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            @if($guest->status === 'pending')
                                                <div class="action-buttons d-flex gap-2">
                                                    <form action="{{ route('admin.guests.approve', $guest->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="bi bi-check-lg me-1"></i> Setujui
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.guests.reject', $guest->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-x-lg me-1"></i> Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-muted small">Sudah diproses</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Info - Solusi untuk masalah firstItem -->
                        <div class="d-flex justify-content-between align-items-center p-3 pagination-container">
                            <div class="pagination-info text-muted">
                                Menampilkan data <b>{{ ($guests->currentPage() - 1) * $guests->perPage() + 1 }}</b>
                                hingga <b>{{ min($guests->currentPage() * $guests->perPage(), $guests->total()) }}</b>
                                dari total <b>{{ $guests->total() }}</b> akun
                            </div>

                            <!-- Pagination Links -->
                            @if($guests->lastPage() > 1)
                            <nav>
                                <ul class="pagination mb-0">
                                    <li class="page-item {{ $guests->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $guests->previousPageUrl() }}">
                                            <i class="bi bi-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for ($i = 1; $i <= $guests->lastPage(); $i++)
                                        <li class="page-item {{ $guests->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $guests->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <li class="page-item {{ !$guests->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $guests->nextPageUrl() }}">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            @endif
                        </div>
                        @else
                        <div class="empty-state">
                            <i class="bi bi-people"></i>
                            <h4 class="mb-2">Belum ada akun guest</h4>
                            <p class="text-muted">Tidak ada permintaan akun guest yang perlu diproses saat ini.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Konfirmasi sebelum menolak akun
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Apakah Anda yakin ingin menolak akun ini?')) {
                    e.preventDefault();
                }
            });
        });

        // Animasi untuk alert
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.add('fade');
            }, 5000);
        });

        // Fitur pencarian real-time
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#guestTable tbody tr');

            rows.forEach(row => {
                const name = row.querySelector('td:first-child').textContent.toLowerCase();
                const nik = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const nip = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                const instansi = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

                if (name.includes(searchTerm) || nik.includes(searchTerm) || nip.includes(searchTerm) || instansi.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
