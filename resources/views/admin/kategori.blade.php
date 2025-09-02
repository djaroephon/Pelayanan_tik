<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #6c757d;
            --success: #198754;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #0dcaf0;
            --light: #f8f9fa;
            --dark: #212529;
            --sidebar-bg: #212529;
            --card-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        /* .main-content {
            flex: 1;
            padding: 20px;
            transition: all 0.3s ease;
            background-color: #f5f7fb;
            min-height: 100vh;
        } */

        /* Header Styles */
        .page-header {
            background: linear-gradient(120deg, #4361ee, #3a56d4);
            border-radius: 10px;
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
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 1.2rem 1.5rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 1.2rem;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(120deg, #4361ee, #3a56d4);
            border: none;
            border-radius: 8px;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
            background: linear-gradient(120deg, #3a56d4, #2f48a8);
        }

        .btn-warning {
            border-radius: 6px;
            padding: 0.4rem 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-danger {
            border-radius: 6px;
            padding: 0.4rem 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .table-custom {
            margin: 0;
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

        /* Alert Styles */
        .alert-custom {
            border-radius: 10px;
            border: none;
            box-shadow: var(--card-shadow);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(120deg, #4361ee, #3a56d4);
            color: white;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .modal-title {
            font-weight: 600;
        }

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* Form Styles */
        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            border-color: #4361ee;
        }

        /* Badge Styles */
        .badge-counter {
            background: linear-gradient(120deg, #4361ee, #3a56d4);
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 0.5rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 15px;
            }

            .page-header {
                padding: 1rem;
            }

            .page-header h1 {
                font-size: 1.5rem;
            }

            .btn-text {
                display: none;
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

        <!-- Content -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <!-- Header -->
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><i class="fas fa-tags me-2"></i>Manajemen Kategori</h1>
                    <span class="badge bg-light text-dark"><i class="fas fa-list me-1"></i> Total: {{ count($kategori) }} Kategori</span>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-custom alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Action Card -->
            <div class="card card-custom">
                <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-cogs me-2"></i>Actions</span>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus-circle me-2"></i><span class="btn-text">Tambah Kategori</span>
                    </button>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <i class="fas fa-list me-2"></i>Daftar Kategori
                </div>
                <div class="card-body p-0">
                    <div class="table-container">
                        <div class="table-responsive">
                            <table class="table table-custom table-hover">
                                <thead>
                                    <tr>
                                        <th width="60">#</th>
                                        <th>Nama Kategori</th>
                                        <th width="200" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori as $item)
                                        <tr>
                                            <td class="text-center"><span class="badge-counter">{{ $loop->iteration }}</span></td>
                                            <td class="fw-semibold">{{ $item->nama_kategori }}</td>
                                            <td class="text-center">
                                                <!-- Tombol Edit -->
                                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </button>

                                                <!-- Tombol Delete -->
                                                <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if(count($kategori) == 0)
                                        <tr>
                                            <td colspan="3" class="text-center py-5">
                                                <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                                <p class="text-muted">Tidak ada data kategori</p>
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
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>Tambah Kategori</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" placeholder="Masukkan nama kategori" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
@foreach ($kategori as $item)
    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('kategori.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Kategori</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" name="nama_kategori" value="{{ $item->nama_kategori }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i> Batal</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Menambahkan efek animasi pada elemen
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi untuk card
        const cards = document.querySelectorAll('.card-custom');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Animasi untuk tabel rows
        const tableRows = document.querySelectorAll('.table-custom tbody tr');
        tableRows.forEach((row, index) => {
            row.style.opacity = '0';
            setTimeout(() => {
                row.style.transition = 'opacity 0.3s ease';
                row.style.opacity = '1';
            }, 500 + (index * 50));
        });
    });
</script>
</body>
</html>
