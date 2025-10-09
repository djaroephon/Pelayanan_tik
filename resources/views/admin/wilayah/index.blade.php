<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Wilayah - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-content {
            padding: 20px;
            margin-left: 280px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: none;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #f8f9fc;
            color: #4e73df;
            font-weight: 700;
        }
        .badge-wilayah {
            background: linear-gradient(45deg, #4361ee, #3a0ca3);
            color: white;
            padding: 0.5em 0.75em;
            border-radius: 20px;
            font-weight: 600;
        }
        .btn-primary {
            background: linear-gradient(45deg, #4361ee, #3a0ca3);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #3a56d4, #2a077c);
        }
    </style>
</head>
<body>
    @include('components.sidebar')

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">Kelola Wilayah</h1>
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

        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="fw-bold m-0"><i class="fas fa-map-marker-alt me-2"></i>Daftar Wilayah</h5>
                <a href="{{ route('wilayah.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Wilayah
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Wilayah</th>
                                <th>IP Address</th>
                                <th>Teknisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wilayahs as $wilayah)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge-wilayah">
                                            {{ $wilayah->nama_wilayah }}
                                        </span>
                                    </td>
                                    <td >
                                        <span class="badge bg-info">{{ $wilayah->ip_address }}</span>
                                    </td>
                                    <td>
                                        @foreach($wilayah->teknisis as $teknisi)
                                            <span class="badge bg-secondary mb-1 text-capitalize">
                                                {{ $teknisi->nama_teknisi }}
                                            </span>
                                        @endforeach
                                        @if($wilayah->teknisis->isEmpty())
                                            <span class="text-muted">Belum ada teknisi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('wilayah.edit', $wilayah->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('wilayah.destroy', $wilayah->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus wilayah ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if($wilayahs->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="fas fa-map-marker-alt fa-2x mb-3 text-muted"></i>
                                        <p class="text-muted">Belum ada data wilayah</p>
                                        <a href="{{ route('wilayah.create') }}" class="btn btn-primary">Tambah Wilayah Pertama</a>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
