<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Teknisi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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

        .btn-action {
            border-radius: 8px;
            padding: 0.4rem 0.8rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
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

        .badge-warning {
            background: linear-gradient(120deg, #ffc107, #e0a800);
            color: #1a202c;
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @include('components.sidebar')

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Header -->
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1><i class="fas fa-users-cog me-2"></i>Daftar Teknisi</h1>
                        <span class="badge bg-light text-dark"><i class="fas fa-users me-1"></i> Total: {{ count($teknisi) }} Teknisi</span>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Main Card -->
                <div class="card card-custom">
                    <div class="card-header card-header-custom">
                        <span><i class="fas fa-list me-2"></i>Daftar Teknisi</span>
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari teknisi...">
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-container">
                            <div class="table-responsive">
                                <table class="table table-custom table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="50">#</th>
                                            <th>Nama Teknisi</th>
                                            <th>No. HP</th>
                                            <th ">Jumlah Tugas Diselesaikan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teknisi as $item)
                                        <tr class="text-center">
                                            <td >{{ $loop->iteration }}</td>
                                            <td class="fw-semibold">{{ $item->nama_teknisi }}</td>
                                            <td>{{ $item->no_hp_teknisi }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-warning"><i class="fas fa-tasks me-1"></i>{{ $item->jumlah_tugas }}</span>
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-teknisi');
            const editForm = document.getElementById('editTeknisiForm');
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('.table-custom tbody tr');

            // Modal edit functionality
            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const url = "{{ route('teknisi.update', ':id') }}".replace(':id', id);
                    editForm.setAttribute('action', url);

                    // Isi data
                    document.getElementById('edit_nama_teknisi').value = this.getAttribute('data-nama');
                    document.getElementById('edit_no_hp_teknisi').value = this.getAttribute('data-nohp');

                    // Tampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('editTeknisiModal'));
                    modal.show();
                });
            });

            // Search functionality
            searchInput.addEventListener('keyup', function() {
                const searchText = this.value.toLowerCase();

                tableRows.forEach(function(row) {
                    const nama = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const noHp = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                    if (nama.includes(searchText) || noHp.includes(searchText)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>
