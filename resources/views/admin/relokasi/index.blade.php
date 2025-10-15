<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Relokasi - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Gunakan style yang sama seperti halaman kelola laporan */
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

        .page-header {
            background: linear-gradient(120deg, #4361ee, #3a56d4);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: var(--card-shadow);
        }

        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-header-custom {
            background: linear-gradient(120deg, #f8f9fc, #e9ecef);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 1.2rem 1.5rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 1.2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .table-custom thead tr {
            background: linear-gradient(120deg, #4361ee, #3a56d4);
            color: white;
        }

        .badge {
            padding: 0.5em 0.8em;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.85em;
        }

        .badge-secondary { background: linear-gradient(120deg, #6c757d, #5a6268); }
        .badge-warning { background: linear-gradient(120deg, #ffc107, #e0a800); color: #1a202c; }
        .badge-success { background: linear-gradient(120deg, #198754, #0f6848); }
        .badge-primary { background: linear-gradient(120deg, #4361ee, #3a56d4); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @include('components.sidebar')

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1><i class="fas fa-exchange-alt me-2"></i>Kelola Relokasi</h1>
                        <span class="badge bg-light text-dark"><i class="fas fa-list me-1"></i> Total: {{ count($relokasis) }} Relokasi</span>
                    </div>
                </div>

                <div class="card card-custom">
                    <div class="card-header card-header-custom">
                        <span><i class="fas fa-table me-2"></i>Daftar Pengajuan Relokasi</span>
                    </div>

                    <div class="card-body">
                        <div class="table-container">
                            <div class="table-responsive">
                                <table id="relokasiTable" class="table table-custom table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="50">No</th>
                                            <th>Nama Pemohon</th>
                                            <th>NIP</th>
                                            <th>Instansi</th>
                                            <th>Jenis Relokasi</th>
                                            <th>Lokasi Awal</th>
                                            <th>Lokasi Tujuan</th>
                                            <th>Teknisi</th>
                                            <th>Status</th>
                                            <th width="120">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($relokasis as $relokasi)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="fw-semibold">{{ $relokasi->nama_pemohon }}</td>
                                            <td>{{ $relokasi->nip }}</td>
                                            <td>{{ $relokasi->instansi }}</td>
                                            <td>
                                                <span class="badge bg-secondary">{{ ucfirst($relokasi->jenis_relokasi) }}</span>
                                            </td>
                                            <td title="{{ $relokasi->instansi_awal }}">
                                                {{ \Illuminate\Support\Str::limit($relokasi->instansi_awal, 30) }}
                                            </td>
                                            <td title="{{ $relokasi->instansi_tujuan }}">
                                                {{ \Illuminate\Support\Str::limit($relokasi->instansi_tujuan, 30) }}
                                            </td>
                                            <td>
                                                @if($relokasi->teknisi)
                                                    <span class="badge badge-primary">{{ $relokasi->teknisi->nama_teknisi }}</span>
                                                @else
                                                    <span class="badge badge-secondary">Belum ditugaskan</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-{{
                                                    $relokasi->status == 'complete' ? 'success' :
                                                    ($relokasi->status == 'pending' ? 'secondary' :
                                                    ($relokasi->status == 'on progress' ? 'warning' : 'danger'))
                                                }}">
                                                    {{ $relokasi->status }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.relokasi.edit', $relokasi->id) }}" class="btn btn-sm btn-primary btn-action" title="Kelola Relokasi">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.relokasi.destroy', $relokasi->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-action" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus relokasi ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#relokasiTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });
        });
    </script>
</body>
</html>
