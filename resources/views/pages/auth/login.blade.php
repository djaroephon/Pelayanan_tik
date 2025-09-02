<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: "Poppins", sans-serif;
            transition: all 0.3s ease;
        }

        body, html {
            height: 100%;
            margin: 0;
        }

        body {
            background: linear-gradient(120deg, #1c908d 0%, #156d6a 100%);
            background-size: cover;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(255, 255, 255, 0.1);
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
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1c908d 0%, #156d6a 100%);
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
            padding: 0.75rem 1rem;
        }

        .form-control {
            border-left: none;
            padding: 0.75rem 1rem;
            height: 50px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(28, 144, 141, 0.25);
            border-color: #1c908d;
        }

        .form-control:focus + .input-group-append .input-group-text {
            border-color: #1c908d;
        }

        .password-toggle-container {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
            background: white;
            height: 30px;
            width: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            cursor: pointer;
        }

        .password-toggle-container:hover {
            color: #1c908d;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1c908d 0%, #156d6a 100%);
            border: none;
            height: 50px;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #156d6a 0%, #11504e 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(28, 144, 141, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
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

        /* Animasi lahh */
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

            .links {
                flex-direction: column;
                gap: 0.5rem;
                align-items: center;
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

            <h3 class="text-center">Login</h3>
            <p class="subtitle">Masukkan nama dan password Anda untuk mengakses sistem</p>

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

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-user text-secondary"></i>
                        </span>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control border-start-0 @error('name') is-invalid @enderror"
                            placeholder="Masukkan nama Anda"
                            required
                            autofocus
                        >
                    </div>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group position-relative">
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
                        <div class="password-toggle-container" id="togglePassword">
                            <i class="far fa-eye"></i>
                        </div>
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
            </form>

            <div class="links">
                <a href="{{ route('landing') }}"><i class="fas fa-home me-1"></i>Kembali ke Beranda</a>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>© 2025 Diskominsa Aceh. All rights reserved.</p>
    </footer>

    <!-- Bootstrap 5 CDN -->
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
            const name = document.getElementById('name').value;
            const password = document.getElementById('password').value;

            if (!name || !password) {
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
