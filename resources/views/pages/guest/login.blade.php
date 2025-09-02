<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Layanan</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/font.css') }}" />
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        * {
            font-family: "Poppins", sans-serif;
        }

        body, html {
            height: 100%;
            margin: 0;
        }

        body {
            background: url('{{ asset('images/123.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(28, 144, 141, 0.7) 0%, rgba(0, 0, 0, 0.6) 100%);
            z-index: 1;
        }

        main {
            position: relative;
            z-index: 2;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        .card {
            max-width: 450px;
            width: 100%;
            padding: 2.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo {
            width: 80px;
            height: 80px;
            background-color: #1c908d;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            box-shadow: 0 5px 15px rgba(28, 144, 141, 0.3);
        }

        h3 {
            color: #1c908d;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #6c757d;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            background-color: white;
            border-right: none;
        }

        .form-control {
            border-left: none;
            padding-left: 0;
            height: 50px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .form-control:focus + .input-group-append .input-group-text {
            border-color: #1c908d;
        }

        .password-toggle {
            cursor: pointer;
            background-color: white;
            color: #6c757d;
            border-left: none;
        }

        .password-toggle:hover {
            color: #1c908d;
        }

        .btn-primary {
            background-color: #1c908d;
            border: none;
            height: 50px;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #156d6a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(28, 144, 141, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #6c757d;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background-color: #dee2e6;
        }

        .divider span {
            padding: 0 1rem;
            font-size: 0.9rem;
        }

        .links {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }

        .links a {
            color: #1c908d;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: #156d6a;
            text-decoration: underline;
        }

        .footer {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 1rem;
            color: white;
            font-size: 0.9rem;
        }

        .footer a {
            color: white;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            animation: fadeIn 0.6s ease-out;
        }

        @media (max-width: 576px) {
            .card {
                padding: 2rem 1.5rem;
            }

            .logo {
                width: 70px;
                height: 70px;
                font-size: 1.7rem;
            }
        }
    </style>
</head>
<body>

    <div class="overlay"></div>

    <main>
        <div class="card">
            <div class="logo-container">
                <div class="logo">
                    <i class="fas fa-user-shield"></i>
                </div>
            </div>

            <h3 class="text-center">Login Layanan</h3>
            <p class="subtitle">Masukkan NIK dan password Anda untuk mengakses sistem</p>

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('guest.login') }}">
                @csrf

                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-id-card text-secondary"></i>
                        </span>
                        <input
                            type="text"
                            id="nik"
                            name="nik"
                            value="{{ old('nik') }}"
                            class="form-control border-start-0 @error('nik') is-invalid @enderror"
                            placeholder="Masukkan NIK Anda"
                            required
                            autofocus
                        >
                    </div>
                    @error('nik')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-lock text-secondary"></i>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control border-start-0 @error('password') is-invalid @enderror"
                            placeholder="Masukkan password Anda"
                            required
                        >
                        <span class="input-group-text password-toggle border-start-0" id="togglePassword">
                            <i class="far fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                    </button>
                </div>

                <div class="divider">
                    <span>Atau</span>
                </div>

                <div class="text-center">
                    <p class="mb-0">Belum punya akun? <a href="{{ route('guest.register') }}">Daftar disini</a></p>
                </div>
            </form>

            <div class="links">
                <a href="{{ route('landing') }}"><i class="fas fa-home me-1"></i>Kembali ke Beranda</a>
                <a href="#"><i class="fas fa-question-circle me-1"></i>Bantuan</a>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>© 2025 Diskominsa Aceh. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            const nik = document.getElementById('nik').value;
            const password = document.getElementById('password').value;

            if (!nik || !password) {
                event.preventDefault();
                alert('Harap isi semua field yang diperlukan');
            }
        });

        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
    </script>

</body>
</html>
