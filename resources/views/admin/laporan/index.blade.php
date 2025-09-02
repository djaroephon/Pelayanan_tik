<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kelola Laporan - Admin Panel</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

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
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .btn-export {
            background: linear-gradient(120deg, #198754, #0f6848);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(25, 135, 84, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-export:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(25, 135, 84, 0.4);
            background: linear-gradient(120deg, #0f6848, #0c5338);
            color: white;
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
            width: 100% !important;
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
            margin-bottom: 0.2rem;
        }

        /* Search Box */
        .search-box {
            position: relative;
            max-width: 250px;
        }

        .search-box input {
            border-radius: 20px;
            padding-left: 2.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            border-color: #4361ee;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        /* Action Button */
        .btn-action {
            border-radius: 8px;
            padding: 0.4rem 0.8rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .card-header-custom {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-box {
                margin-top: 1rem;
                max-width: 100%;
                width: 100%;
            }
        }

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

            .table-custom thead th,
            .table-custom tbody td {
                padding: 0.75rem 0.5rem;
            }

            .badge {
                font-size: 0.75em;
                padding: 0.4em 0.6em;
            }
        }

        /* DataTables Customization */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            margin: 0 3px;
            border: 1px solid #dee2e6 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(120deg, #4361ee, #3a56d4) !important;
            color: white !important;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            padding: 0.375rem 0.75rem;
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
                        <h1><i class="fas fa-clipboard-list me-2"></i>Kelola Laporan</h1>
                        <span class="badge bg-light text-dark"><i class="fas fa-list me-1"></i> Total: {{ count($laporans) }} Laporan</span>
                    </div>
                </div>

                <!-- Main Card -->
                <div class="card card-custom">
                    <div class="card-header card-header-custom">
                        <span><i class="fas fa-table me-2"></i>Daftar Laporan</span>
                        <div class="d-flex">
                            <div class="search-box me-4">
                                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari laporan...">
                            </div>
                            <a href="{{ route('export.laporan') }}" class="btn-export">
                                <i class="fas fa-file-export me-2"></i>Export
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-container">
                            <div class="table-responsive">
                                <table id="laporanTable" class="table table-custom table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="50">No</th>
                                            <th>Nama Pelapor</th>
                                            <th>No HP</th>
                                            <th>Email</th>
                                            <th>Instansi</th>
                                            <th>Permasalahan</th>
                                            <th>Waktu</th>
                                            <th>Kategori</th>
                                            <th>Teknisi</th>
                                            <th>Status</th>
                                            <th width="80">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($laporans as $laporan)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="fw-semibold">{{ $laporan->nama_pelapor }}</td>
                                            <td>{{ $laporan->no_hp_pelapor }}</td>
                                            <td>{{ $laporan->email_pelapor }}</td>
                                            <td>{{ $laporan->instansi }}</td>
                                            <td title="{{ $laporan->laporan_permasalahan }}">
                                                {{ \Illuminate\Support\Str::limit($laporan->laporan_permasalahan, 50) }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($laporan->waktu_permasalahan)->format('d M Y H:i') }}</td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $laporan->kategori->nama_kategori }}</span>
                                            </td>
                                            <td>
                                                @foreach($laporan->teknisis as $teknisi)
                                                    <span class="badge badge-primary mb-1">{{ $teknisi->nama_teknisi }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <span class="badge badge-{{
                                                    $laporan->status == 'complete' ? 'success' :
                                                    ($laporan->status == 'pending' ? 'secondary' :
                                                    ($laporan->status == 'on progress' ? 'warning' : 'danger'))
                                                }}">
                                                    {{ $laporan->status }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('laporan.edit', $laporan->id) }}" class="btn btn-sm btn-primary btn-action" title="Kelola Laporan">
                                                    <i class="fas fa-edit"></i>
                                                </a>
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#laporanTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                },
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 },
                    { responsivePriority: 3, targets: 1 }
                ],
                initComplete: function() {
                    // Add custom styling after DataTable initialization
                    $('.dataTables_length select').addClass('form-select form-select-sm');
                    $('.dataTables_filter input').addClass('form-control form-control-sm');
                }
            });

            // Search functionality
            $('#searchInput').keyup(function(){
                table.search($(this).val()).draw();
            });

            // Add animation to table rows
            $('#laporanTable tbody tr').each(function(i) {
                $(this).delay(i * 50).fadeIn(300);
            });
        });
    </script>
</body>
</html>
