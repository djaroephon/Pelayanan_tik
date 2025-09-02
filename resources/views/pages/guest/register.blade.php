<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register Layanan</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/font.css') }}" />
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome untuk ikon -->
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

        /* Overlay dengan gradient */
        .overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(28, 144, 141, 0.8) 0%, rgba(0, 0, 0, 0.6) 100%);
            z-index: 1;
        }

        /* Container form supaya di atas overlay */
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
            max-width: 550px;
            width: 100%;
            padding: 2.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(10px);
            border: none;
            transform: translateY(0);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
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
            box-shadow: 0 5px 15px rgba(28, 144, 141, 0.4);
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
            display: flex;
            align-items: center;
        }

        .form-label .required {
            color: #dc3545;
            margin-left: 4px;
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
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .form-control:focus + .input-group-append .input-group-text {
            border-color: #1c908d;
        }

        /* Perbaikan posisi icon mata */
        .password-toggle-container {
            position: relative;
        }

        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 5;
            background: white;
            padding: 5px;
            border-radius: 4px;
        }

        .password-toggle:hover {
            color: #1c908d;
        }

        .file-upload {
            position: relative;
            overflow: hidden;
        }

        .file-upload-label {
            display: block;
            padding: 10px 15px;
            background: #f8f9fa;
            border: 1px dashed #ced4da;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-label:hover {
            background: #e9ecef;
            border-color: #1c908d;
        }

        .file-name {
            font-size: 0.9rem;
            margin-top: 5px;
            color: #6c757d;
        }

        .download-link {
            color: #1c908d;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .download-link:hover {
            color: #156d6a;
            text-decoration: underline;
        }

        .download-link i {
            margin-right: 5px;
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

        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }

        .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #6c757d;
            position: relative;
            z-index: 2;
        }

        .step.active {
            background-color: #1c908d;
            color: white;
        }

        .step.completed {
            background-color: #198754;
            color: white;
        }

        .step-line {
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #e9ecef;
            z-index: 1;
        }

        .step-progress {
            position: absolute;
            top: 15px;
            left: 0;
            height: 2px;
            background-color: #1c908d;
            z-index: 1;
            transition: width 0.5s ease;
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
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

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .card {
            animation: fadeIn 0.6s ease-out;
        }

        .shake {
            animation: shake 0.5s;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .card {
                padding: 2rem 1.5rem;
            }

            .logo {
                width: 70px;
                height: 70px;
                font-size: 1.7rem;
            }

            .nav-buttons {
                flex-direction: column;
                gap: 10px;
            }

            .nav-buttons button {
                width: 100%;
            }

            .password-toggle {
                right: 8px;
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
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>

            <h3 class="text-center">Registrasi Layanan</h3>
            <p class="subtitle">Lengkapi data berikut untuk membuat akun layanan</p>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Terjadi kesalahan!</strong> Silakan periksa form di bawah.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="mt-2">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="step-indicator mb-4">
                <div class="step-line"></div>
                <div class="step-progress" id="stepProgress"></div>
                <div class="step active">1</div>
                <div class="step">2</div>
                <div class="step">3</div>
            </div>

            <form method="POST" action="{{ route('guest.register') }}" enctype="multipart/form-data" id="registrationForm">
                @csrf

                <div class="form-section active" id="section1">
                    <h5 class="mb-4"><i class="fas fa-user me-2 text-primary"></i>Informasi Pribadi</h5>

                    <div class="mb-3">
                        <label for="nama_pelapor" class="form-label">Nama Lengkap<span class="required">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-user text-secondary"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 @error('nama_pelapor') is-invalid @enderror" id="nama_pelapor" name="nama_pelapor"
                                placeholder="Masukkan nama lengkap" required value="{{ old('nama_pelapor') }}">
                        </div>
                        @error('nama_pelapor')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK<span class="required">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-id-card text-secondary"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 @error('nik') is-invalid @enderror" id="nik" name="nik"
                                placeholder="Masukkan NIK" required value="{{ old('nik') }}">
                        </div>
                        @error('nik')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP<span class="required">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-id-badge text-secondary"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 @error('nip') is-invalid @enderror" id="nip" name="nip"
                                placeholder="Masukkan NIP" required value="{{ old('nip') }}">
                        </div>
                        @error('nip')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="instansi" class="form-label">Instansi<span class="required">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-building text-secondary"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 @error('instansi') is-invalid @enderror" id="instansi" name="instansi"
                                placeholder="Masukkan nama instansi" required value="{{ old('instansi') }}">
                        </div>
                        @error('instansi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="nav-buttons">
                        <div></div> <!-- Untuk spacing  -->
                        <button type="button" class="btn btn-primary next-btn">Selanjutnya <i class="fas fa-arrow-right ms-2"></i></button>
                    </div>
                </div>

                <div class="form-section" id="section2">
                    <h5 class="mb-4"><i class="fas fa-file me-2 text-primary"></i>Unggah Dokumen</h5>

                    <div class="mb-3">
                        <label for="surat_pernyataan_pengelola" class="form-label">Surat Pernyataan Pengelola (PDF)<span class="required">*</span></label>
                        <div class="file-upload">
                            <label for="surat_pernyataan_pengelola" class="file-upload-label @error('surat_pernyataan_pengelola') border-danger @enderror">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File PDF
                            </label>
                            <input type="file" class="d-none" id="surat_pernyataan_pengelola" name="surat_pernyataan_pengelola" accept=".pdf" required>
                            <div class="file-name" id="suratFileName">Belum ada file dipilih</div>
                        </div>
                        @error('surat_pernyataan_pengelola')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="mt-2">
                            <a href="{{ route('guest.download.template') }}" class="download-link">
                                <i class="fas fa-download me-1"></i>Unduh Template Surat
                            </a>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="ktp" class="form-label">Foto KTP (JPG/PNG)<span class="required">*</span></label>
                        <div class="file-upload">
                            <label for="ktp" class="file-upload-label @error('ktp') border-danger @enderror">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Gambar
                            </label>
                            <input type="file" class="d-none" id="ktp" name="ktp" accept=".jpg,.jpeg,.png" required>
                            <div class="file-name" id="ktpFileName">Belum ada file dipilih</div>
                        </div>
                        @error('ktp')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="nav-buttons">
                        <button type="button" class="btn btn-outline-secondary prev-btn"><i class="fas fa-arrow-left me-2"></i>Sebelumnya</button>
                        <button type="button" class="btn btn-primary next-btn">Selanjutnya <i class="fas fa-arrow-right ms-2"></i></button>
                    </div>
                </div>

                <div class="form-section" id="section3">
                    <h5 class="mb-4"><i class="fas fa-lock me-2 text-primary"></i>Informasi Akun</h5>

                    <div class="mb-3 position-relative password-toggle-container">
                        <label for="password" class="form-label">Password<span class="required">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-key text-secondary"></i>
                            </span>
                            <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" id="password" name="password"
                                placeholder="Buat password yang kuat" required>
                        </div>
                        <span class="password-toggle" id="togglePassword">
                            <i class="far fa-eye"></i>
                        </span>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Gunakan minimal 8 karakter dengan kombinasi huruf, angka, dan simbol</div>
                    </div>

                    <div class="mb-4 position-relative password-toggle-container">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password<span class="required">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-key text-secondary"></i>
                            </span>
                            <input type="password" class="form-control border-start-0" id="password_confirmation" name="password_confirmation"
                                placeholder="Ulangi password Anda" required>
                        </div>
                        <span class="password-toggle" id="togglePasswordConfirmation">
                            <i class="far fa-eye"></i>
                        </span>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="termsAgree" name="terms" required>
                        <label class="form-check-label" for="termsAgree">
                            Saya menyetujui <a href="#">syarat dan ketentuan</a> yang berlaku
                        </label>
                        @error('terms')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="nav-buttons">
                        <button type="button" class="btn btn-outline-secondary prev-btn"><i class="fas fa-arrow-left me-2"></i>Sebelumnya</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>Daftar
                        </button>
                    </div>
                </div>
            </form>

            <div class="links">
                <a href="{{ route('landing') }}"><i class="fas fa-home me-1"></i>Kembali ke Beranda</a>
                <a href="{{ route('guest.login') }}"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>© 2025 Diskominsa Aceh. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sections = document.querySelectorAll('.form-section');
        const steps = document.querySelectorAll('.step');
        const stepProgress = document.getElementById('stepProgress');
        const nextButtons = document.querySelectorAll('.next-btn');
        const prevButtons = document.querySelectorAll('.prev-btn');
        let currentSection = 0;

        updateProgress();

        nextButtons.forEach(button => {
            button.addEventListener('click', () => {
                if (validateSection(currentSection)) {
                    if (currentSection < sections.length - 1) {
                        sections[currentSection].classList.remove('active');
                        steps[currentSection].classList.remove('active');
                        steps[currentSection].classList.add('completed');

                        currentSection++;

                        sections[currentSection].classList.add('active');
                        steps[currentSection].classList.add('active');
                        updateProgress();
                    }
                } else {
                    const activeSection = document.querySelector('.form-section.active');
                    activeSection.classList.add('shake');
                    setTimeout(() => {
                        activeSection.classList.remove('shake');
                    }, 500);
                }
            });
        });

        prevButtons.forEach(button => {
            button.addEventListener('click', () => {
                sections[currentSection].classList.remove('active');
                steps[currentSection].classList.remove('active');

                currentSection--;

                sections[currentSection].classList.add('active');
                steps[currentSection].classList.add('active');
                updateProgress();
            });
        });

        function updateProgress() {
            const progress = (currentSection / (sections.length - 1)) * 100;
            stepProgress.style.width = `${progress}%`;
        }

        function validateSection(sectionIndex) {
            const inputs = sections[sectionIndex].querySelectorAll('input[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (sectionIndex === 1) {
                const suratFile = document.getElementById('surat_pernyataan_pengelola');
                const ktpFile = document.getElementById('ktp');

                if (!suratFile.files.length) {
                    document.querySelector('label[for="surat_pernyataan_pengelola"]').classList.add('border-danger');
                    isValid = false;
                } else {
                    document.querySelector('label[for="surat_pernyataan_pengelola"]').classList.remove('border-danger');
                }

                if (!ktpFile.files.length) {
                    document.querySelector('label[for="ktp"]').classList.add('border-danger');
                    isValid = false;
                } else {
                    document.querySelector('label[for="ktp"]').classList.remove('border-danger');
                }
            }

            return isValid;
        }

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

        document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
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

        document.getElementById('surat_pernyataan_pengelola').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Belum ada file dipilih';
            document.getElementById('suratFileName').textContent = fileName;
            document.querySelector('label[for="surat_pernyataan_pengelola"]').classList.remove('border-danger');
        });

        document.getElementById('ktp').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Belum ada file dipilih';
            document.getElementById('ktpFileName').textContent = fileName;
            document.querySelector('label[for="ktp"]').classList.remove('border-danger');
        });

        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password !== passwordConfirmation) {
                event.preventDefault();
                alert('Konfirmasi password tidak sesuai!');
                document.getElementById('password_confirmation').classList.add('is-invalid');
            }

            if (!document.getElementById('termsAgree').checked) {
                event.preventDefault();
                alert('Anda harus menyetujui syarat dan ketentuan untuk melanjutkan.');
                document.getElementById('termsAgree').classList.add('is-invalid');
            }
        });

        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.parentElement.classList.remove('focused');
            });
        });
    </script>

</body>
</html>
