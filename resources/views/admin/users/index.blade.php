<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --border: #dee2e6;
            --shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 1rem 3rem rgba(0, 0, 0, 0.1);
            --radius: 0.75rem;
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
            border-radius: var(--radius);
            padding: 1.5rem;
            color: white;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow);
        }

        .card {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            background: linear-gradient(120deg, #f8f9fc, #e9ecef);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 1.2rem 1.5rem;
            font-weight: 600;
        }

        .table-responsive {
            border-radius: var(--radius);
            overflow: hidden;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 600;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #f1f3f9;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
            transform: scale(1.01);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.5em 0.75em;
        }

        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            border: none;
            color: #212529;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #218838);
            border: none;
        }

        .search-box .form-control {
            border-radius: 0.5rem 0 0 0.5rem;
            border: 1px solid #e2e8f0;
        }

        .search-box .btn {
            border-radius: 0 0.5rem 0.5rem 0;
            background: #f8f9fa;
            border: 1px solid #e2e8f0;
            color: var(--gray);
        }

        /* Role-specific Fields */
        .role-fields {
            display: none;
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            background: linear-gradient(120deg, #f8f9fc, #e9ecef);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #4361ee;
            animation: fadeIn 0.3s ease;
        }

        .technician-fields {
            border-left-color: #198754;
        }

        .penjab-fields {
            border-left-color: #ffc107;
        }

        .role-header {
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .technician-header {
            color: #198754;
        }

        .penjab-header {
            color: #ffc107;
        }

        .role-header i {
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        /* Layanan items */
        .layanan-item {
            margin-bottom: 10px;
        }

        .layanan-badge {
            display: inline-block;
            margin: 2px;
            font-size: 0.75rem;
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: var(--radius) var(--radius) 0 0;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1rem;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 1rem;
            }

            .page-header {
                padding: 1rem;
            }

            .page-header h1 {
                font-size: 1.5rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.875rem;
            }

            .badge {
                font-size: 0.7rem;
            }
        }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="content-wrapper">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h1 class="h2 mb-1"><i class="fas fa-users me-2"></i>Kelola Akun Pengguna</h1>
                                <p class="mb-0 opacity-75">Kelola akses pengguna ke dalam sistem</p>
                            </div>
                            <div class="search-box mt-2 mt-md-0">
                                <div class="input-group" style="max-width: 300px;">
                                    <input type="text" class="form-control" placeholder="Cari pengguna..." id="searchInput">
                                    <button class="btn" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alert Notification -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center">
                            <i class="fas fa-check-circle me-2"></i>
                            <div class="flex-grow-1">{{ session('success') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    @if(auth()->user()->role === 'admin')
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i> Tambah Pengguna Baru
                        </a>
                        <div class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Total: {{ $users->count() }} Pengguna
                        </div>
                    </div>
                    @endif

                    <!-- Users Table -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Pengguna</h5>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary me-2">{{ $users->where('role', 'admin')->count() }} Admin</span>
                                <span class="badge bg-warning me-2">{{ $users->where('role', 'operator')->count() }} Operator</span>
                                <span class="badge bg-info me-2">{{ $users->where('role', 'teknisi')->count() }} Teknisi</span>
                                <span class="badge bg-secondary">{{ $users->where('role', 'penjab')->count() }} Penjab</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0" id="usersTable">
                                    <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th>Nama Pengguna</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Layanan</th>
                                            <th width="200" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td class="fw-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded-circle d-flex align-items-center justify-content-center me-2">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </div>
                                                    <span class="text-capitalize">{{ $user->name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @php
                                                    $badgeColor = [
                                                        'admin' => 'danger',
                                                        'operator' => 'warning',
                                                        'teknisi' => 'info',
                                                        'penjab' => 'secondary'
                                                    ][$user->role];
                                                @endphp
                                                <span class="badge bg-{{ $badgeColor }}">
                                                    <i class="fas fa-{{
                                                        $user->role === 'admin' ? 'user-shield' :
                                                        ($user->role === 'operator' ? 'user-cog' :
                                                        ($user->role === 'teknisi' ? 'tools' : 'user-tie'))
                                                    }} me-1"></i>
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($user->role === 'penjab' && $user->penjabLayanans->count() > 0)
                                                    <div class="d-flex flex-wrap gap-1">
                                                        @foreach($user->penjabLayanans as $layanan)
                                                            <span class="badge bg-primary layanan-badge">
                                                                <i class="fas fa-layer-group me-1"></i>{{ $layanan->nama_penjab_layanan }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if(auth()->user()->role === 'admin')
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button class="btn btn-warning edit-user"
                                                            data-id="{{ $user->id }}"
                                                            data-name="{{ $user->name }}"
                                                            data-email="{{ $user->email }}"
                                                            data-role="{{ $user->role }}"
                                                            @if($user->teknisi)
                                                            data-no-hp-teknisi="{{ $user->teknisi->no_hp_teknisi }}"
                                                            @endif
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editUserModal">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>

                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                                @else
                                                <span class="text-muted"><i class="fas fa-eye me-1"></i>Hanya lihat</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    @if($users->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada pengguna</h4>
                        <p class="text-muted">Mulai dengan menambahkan pengguna pertama</p>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mt-2">
                            <i class="fas fa-user-plus me-2"></i>Tambah Pengguna
                        </a>
                    </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">
                            <i class="fas fa-user-edit me-2"></i>Edit Pengguna
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_name" class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="edit_name" name="name" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="edit_email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="edit_email" name="email" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="edit_password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="edit_password" name="password" placeholder="Kosongkan jika tidak diubah">
                                </div>
                                <small class="form-text text-muted">Minimal 8 karakter</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="edit_password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="edit_password_confirmation" name="password_confirmation">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="edit_role" class="form-label">Role</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    <select class="form-select" id="edit_role" name="role" required>
                                        <option value="admin">Admin</option>
                                        <option value="operator">Operator</option>
                                        <option value="teknisi">Teknisi</option>
                                        <option value="penjab">Penjab</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Technician Fields -->
                        <div class="role-fields technician-fields" id="editTechnicianFields">
                            <h5 class="role-header technician-header"><i class="fas fa-tools"></i>Data Teknisi</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="edit_no_hp_teknisi" class="form-label">Nomor HP</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="text" class="form-control" id="edit_no_hp_teknisi" name="no_hp_teknisi" placeholder="Contoh: 081234567890">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Penjab Fields -->
                        <div class="role-fields penjab-fields" id="editPenjabFields">
                            <h5 class="role-header penjab-header"><i class="fas fa-user-tie"></i>Data Penjab Layanan</h5>
                            <div class="mb-3">
                                <label class="form-label">Layanan yang Dikelola</label>
                                <div id="edit-layanan-container">
                                    <!-- Dynamic inputs will be added here -->
                                </div>
                                <button type="button" class="btn btn-sm btn-success mt-2" id="edit-tambah-layanan">
                                    <i class="fas fa-plus me-1"></i> Tambah Layanan
                                </button>
                                <small class="form-text text-muted">Klik tombol + untuk menambah layanan lainnya</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitEditBtn">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#usersTable tbody tr');

                    rows.forEach(row => {
                        const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                        const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                        const role = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

                        if (name.includes(searchTerm) || email.includes(searchTerm) || role.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }

            // Handle edit modal
            const editButtons = document.querySelectorAll('.edit-user');
            const editForm = document.getElementById('editUserForm');
            const editTechnicianFields = document.getElementById('editTechnicianFields');
            const editPenjabFields = document.getElementById('editPenjabFields');
            const editRoleSelect = document.getElementById('edit_role');
            const editLayananContainer = document.getElementById('edit-layanan-container');
            const editTambahLayananBtn = document.getElementById('edit-tambah-layanan');
            const submitEditBtn = document.getElementById('submitEditBtn');

            // Function to add layanan input in edit modal
            function addEditLayananInput(value = '') {
                const newItem = document.createElement('div');
                newItem.className = 'input-group mb-2 layanan-item';
                newItem.innerHTML = `
                    <input type="text" class="form-control" name="nama_penjab_layanan[]"
                           placeholder="Masukkan nama layanan" value="${value}" required>
                    <button type="button" class="btn btn-danger btn-hapus-edit-layanan">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                editLayananContainer.appendChild(newItem);
            }

            // Event untuk tambah layanan di edit modal
            editTambahLayananBtn.addEventListener('click', function() {
                addEditLayananInput();
            });

            // Event delegation untuk hapus layanan di edit modal
            editLayananContainer.addEventListener('click', function(e) {
                if (e.target.closest('.btn-hapus-edit-layanan')) {
                    if (editLayananContainer.children.length > 1) {
                        e.target.closest('.layanan-item').remove();
                    }
                }
            });

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const userId = this.dataset.id;
                    const url = "{{ route('admin.users.update', ':id') }}".replace(':id', userId);

                    // Set form action
                    editForm.setAttribute('action', url);

                    // Fill form data
                    document.getElementById('edit_name').value = this.dataset.name;
                    document.getElementById('edit_email').value = this.dataset.email;
                    document.getElementById('edit_role').value = this.dataset.role;

                    // Clear password fields
                    document.getElementById('edit_password').value = '';
                    document.getElementById('edit_password_confirmation').value = '';

                    // Clear layanan container
                    editLayananContainer.innerHTML = '';

                    // Handle technician fields
                    if (this.dataset.role === 'teknisi' && this.dataset.noHpTeknisi) {
                        document.getElementById('edit_no_hp_teknisi').value = this.dataset.noHpTeknisi;
                        editTechnicianFields.style.display = 'block';
                        editPenjabFields.style.display = 'none';
                    } else {
                        editTechnicianFields.style.display = 'none';
                        document.getElementById('edit_no_hp_teknisi').value = '';
                    }

                    // Handle penjab fields
                    if (this.dataset.role === 'penjab') {
                        editPenjabFields.style.display = 'block';
                        editTechnicianFields.style.display = 'none';

                        // Show loading state
                        editLayananContainer.innerHTML = '<div class="text-center py-3"><div class="loading"></div> Memuat data...</div>';

                        // Load layanan data via AJAX
                        fetch(`/admin/users/${userId}/layanan`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                editLayananContainer.innerHTML = '';
                                if (data.length > 0) {
                                    data.forEach(layanan => {
                                        addEditLayananInput(layanan.nama_penjab_layanan);
                                    });
                                } else {
                                    addEditLayananInput();
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                editLayananContainer.innerHTML = '';
                                addEditLayananInput();
                            });
                    } else {
                        editPenjabFields.style.display = 'none';
                    }
                });
            });

            // Show/hide fields when role changes in edit modal
            editRoleSelect.addEventListener('change', function() {
                if (this.value === 'teknisi') {
                    editTechnicianFields.style.display = 'block';
                    editPenjabFields.style.display = 'none';
                } else if (this.value === 'penjab') {
                    editTechnicianFields.style.display = 'none';
                    editPenjabFields.style.display = 'block';

                    // Add at least one layanan field if empty
                    if (editLayananContainer.children.length === 0) {
                        addEditLayananInput();
                    }
                } else {
                    editTechnicianFields.style.display = 'none';
                    editPenjabFields.style.display = 'none';
                }
            });

            // Form submission loading state
            editForm.addEventListener('submit', function() {
                submitEditBtn.innerHTML = '<div class="loading"></div> Menyimpan...';
                submitEditBtn.disabled = true;
            });
        });
    </script>
</body>
</html>
