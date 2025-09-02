<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna</title>
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
        .technician-fields {
            display: none;
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background-color: #f8f9fa;
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

    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @include('components.sidebar')

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="content-wrapper">
                    <div class="page-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h2 mb-0"><i class="bi bi-people me-2"></i>Kelola Akun Pengguna</h1>
                                <p class="mb-0 opacity-75">Kelola akses pengguna ke sistem</p>
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
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-user-plus me-1"></i> Tambah Pengguna
                </a>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-capitalize">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'operator' ? 'warning' : 'info') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    @if(auth()->user()->role === 'admin')
                                    <button class="btn btn-sm btn-warning edit-user"
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
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-muted">Hanya lihat</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_password" class="form-label">Password (biarkan kosong jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control" id="edit_password" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="edit_password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="edit_password_confirmation" name="password_confirmation">
                        </div>

                        <div class="mb-3">
                            <label for="edit_role" class="form-label">Role</label>
                            <select class="form-select" id="edit_role" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                                <option value="teknisi">Teknisi</option>
                            </select>
                        </div>

                        <div class="technician-fields" id="editTechnicianFields">
                            <h5 class="mb-3">Data Teknisi</h5>
                            <div class="mb-3">
                                <label for="edit_no_hp_teknisi" class="form-label">Nomor HP</label>
                                <input type="text" class="form-control" id="edit_no_hp_teknisi" name="no_hp_teknisi">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle edit modal
            const editButtons = document.querySelectorAll('.edit-user');
            const editForm = document.getElementById('editUserForm');
            const editTechnicianFields = document.getElementById('editTechnicianFields');
            const editRoleSelect = document.getElementById('edit_role');

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

                    // Handle technician fields
                    if (this.dataset.role === 'teknisi' && this.dataset.noHpTeknisi) {
                        document.getElementById('edit_no_hp_teknisi').value = this.dataset.noHpTeknisi;
                        editTechnicianFields.style.display = 'block';
                    } else {
                        editTechnicianFields.style.display = 'none';
                    }
                });
            });

            // Show/hide technician fields when role changes
            editRoleSelect.addEventListener('change', function() {
                if (this.value === 'teknisi') {
                    editTechnicianFields.style.display = 'block';
                } else {
                    editTechnicianFields.style.display = 'none';
                }
            });
        });

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
