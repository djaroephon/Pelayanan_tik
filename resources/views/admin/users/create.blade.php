<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna Baru - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        .card-header-custom {
            background: linear-gradient(120deg, #f8f9fc, #e9ecef);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 1.2rem 1.5rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 1.2rem;
        }

        /* Form Styles */
        .form-section {
            padding: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            border-color: #4361ee;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #e2e8f0;
            border-radius: 8px 0 0 8px;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(120deg, #4361ee, #3a56d4);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
            background: linear-gradient(120deg, #3a56d4, #2f48a8);
        }

        .btn-secondary {
            background: linear-gradient(120deg, #6c757d, #5a6268);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            box-shadow: 0 4px 10px rgba(108, 117, 125, 0.3);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(108, 117, 125, 0.4);
            background: linear-gradient(120deg, #5a6268, #495057);
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

        /* Alert Styles */
        .alert-custom {
            border-radius: 10px;
            border: none;
            box-shadow: var(--card-shadow);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Adjustments */
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

            .form-section {
                padding: 1rem;
            }
        }

        .layanan-item {
            margin-bottom: 10px;
        }

        .btn-tambah-layanan, .btn-hapus-layanan {
            border-radius: 0 8px 8px 0;
        }

        .layanan-item:first-child .btn-hapus-layanan {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('components.sidebar')

            <!-- Main Content -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Header -->
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1><i class="fas fa-user-plus me-2"></i>Tambah Pengguna Baru</h1>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger alert-custom">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-2 fa-lg"></i>
                            <h5 class="mb-0">Terjadi Kesalahan</h5>
                        </div>
                        <hr>
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card card-custom">
                    <div class="card-header card-header-custom">
                        <i class="fas fa-user-circle me-2"></i>Form Tambah Pengguna
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf

                            <div class="form-section">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan alamat email">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Konfirmasi password">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                            <select class="form-select" id="role" name="role" required>
                                                <option value="">Pilih Role</option>
                                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                                                <option value="penjab" {{ old('role') == 'penjab' ? 'selected' : '' }}>Penjab</option>
                                                <option value="teknisi" {{ old('role') == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Technician Fields -->
                            <div class="role-fields technician-fields" id="technicianFields">
                                <h5 class="role-header technician-header"><i class="fas fa-tools"></i>Data Teknisi</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="no_hp_teknisi" class="form-label">Nomor HP</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="text" class="form-control" id="no_hp_teknisi" name="no_hp_teknisi" value="{{ old('no_hp_teknisi') }}" placeholder="Masukkan nomor HP teknisi">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Penjab Fields -->
                            <div class="role-fields penjab-fields" id="penjabFields">
                                <h5 class="role-header penjab-header"><i class="fas fa-user-tie"></i>Data Penjab Layanan</h5>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Layanan yang Dikelola</label>
                                        <div id="layanan-container">
                                            <div class="input-group mb-2 layanan-item">
                                                <input type="text" class="form-control" name="nama_penjab_layanan[]"
                                                       placeholder="Masukkan nama layanan (contoh: Keamanan Jaringan)" required>
                                                <button type="button" class="btn btn-success btn-tambah-layanan">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">Klik tombol + untuk menambah layanan lainnya</small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-1"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const technicianFields = document.getElementById('technicianFields');
            const penjabFields = document.getElementById('penjabFields');
            const layananContainer = document.getElementById('layanan-container');

            // Function to show/hide fields based on role
            function toggleRoleFields() {
                // Hide all fields first
                technicianFields.style.display = 'none';
                penjabFields.style.display = 'none';

                // Remove required attributes
                document.getElementById('no_hp_teknisi')?.removeAttribute('required');

                // Remove required from all layanan inputs
                const layananInputs = document.querySelectorAll('input[name="nama_penjab_layanan[]"]');
                layananInputs.forEach(input => input.removeAttribute('required'));

                // Show specific fields based on role
                if (roleSelect.value === 'teknisi') {
                    technicianFields.style.display = 'block';
                    document.getElementById('no_hp_teknisi').setAttribute('required', '');
                } else if (roleSelect.value === 'penjab') {
                    penjabFields.style.display = 'block';
                    // Set required for all layanan inputs
                    const layananInputs = document.querySelectorAll('input[name="nama_penjab_layanan[]"]');
                    layananInputs.forEach(input => input.setAttribute('required', ''));
                }
            }

            // Show/hide fields based on role selection
            roleSelect.addEventListener('change', toggleRoleFields);

            // Show fields if there was a validation error
            if (roleSelect.value === 'teknisi' || roleSelect.value === 'penjab') {
                toggleRoleFields();
            }

            // Add new layanan field
            document.querySelector('.btn-tambah-layanan').addEventListener('click', function() {
                const newItem = document.createElement('div');
                newItem.className = 'input-group mb-2 layanan-item';
                newItem.innerHTML = `
                    <input type="text" class="form-control" name="nama_penjab_layanan[]"
                           placeholder="Masukkan nama layanan">
                    <button type="button" class="btn btn-danger btn-hapus-layanan">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                layananContainer.appendChild(newItem);
            });

            // Remove layanan field
            layananContainer.addEventListener('click', function(e) {
                if (e.target.closest('.btn-hapus-layanan')) {
                    e.target.closest('.layanan-item').remove();
                }
            });

            // Add animation to form elements
            const formElements = document.querySelectorAll('.form-control, .form-select');
            formElements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    element.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Phone number validation for technician
            const noHpTeknisi = document.getElementById('no_hp_teknisi');
            if (noHpTeknisi) {
                noHpTeknisi.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9+]/g, '');
                });
            }
        });
    </script>
</body>
</html>
