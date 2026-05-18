@extends('layouts.main')

@section('title', 'Daftar Layanan | Diskominsa Aceh')

@section('content')
<section class="relative flex min-h-screen items-center justify-center overflow-hidden bg-surface-50 pt-24 sm:pt-32 pb-12 sm:pb-20 px-4 sm:px-6">
    <!-- Background Accents -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-1/4 -left-20 w-64 h-64 md:w-[30rem] md:h-[30rem] bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute bottom-1/4 -right-20 w-64 h-64 md:w-[30rem] md:h-[30rem] bg-accent-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    </div>

    <div class="relative z-10 w-full max-w-2xl register-card opacity-0">
        <div class="glass overflow-hidden rounded-[2rem] sm:rounded-[2.5rem] p-6 sm:p-8 md:p-12 shadow-2xl">
            <!-- Header -->
            <div class="mb-8 md:mb-10 text-center">
                <div class="mx-auto mb-6 flex h-14 w-14 sm:h-16 sm:w-16 items-center justify-center rounded-2xl bg-primary-600 p-3 shadow-lg shadow-primary-600/20">
                    <i data-lucide="user-plus" class="h-full w-full text-white"></i>
                </div>
                <h2 class="font-display text-2xl sm:text-3xl font-bold tracking-tight text-surface-900">Registrasi Akun</h2>
                <p class="mt-2 text-sm sm:text-base text-surface-500">Lengkapi data untuk mengakses portal layanan TIK</p>
            </div>

            <!-- Step Indicator -->
            <div class="mb-10 sm:mb-12">
                <div class="relative flex items-center justify-between">
                    <div class="absolute left-0 top-1/2 h-1 w-full -translate-y-1/2 bg-surface-100"></div>
                    <div id="step-progress" class="absolute left-0 top-1/2 h-1 w-0 -translate-y-1/2 bg-primary-600 transition-all duration-500"></div>
                    
                    @foreach([1, 2, 3] as $step)
                        <div class="step-item relative z-10 flex h-8 w-8 sm:h-10 sm:w-10 items-center justify-center rounded-full border-4 border-surface-50 bg-white text-sm sm:text-base font-bold text-surface-400 transition-all duration-500 {{ $step == 1 ? 'active border-primary-600 text-primary-600' : '' }}" data-step="{{ $step }}">
                            {{ $step }}
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 flex justify-between px-1 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest text-surface-400">
                    <span>Pribadi</span>
                    <span>Dokumen</span>
                    <span>Keamanan</span>
                </div>
            </div>

            <!-- Alerts -->
            @if($errors->any())
                <div class="mb-8 rounded-2xl bg-red-50 p-4 sm:p-6 text-sm text-red-600 border border-red-100">
                    <div class="flex items-center space-x-2 mb-2 font-bold">
                        <i data-lucide="alert-circle" class="h-5 w-5"></i>
                        <span>Mohon perbaiki kesalahan berikut:</span>
                    </div>
                    <ul class="list-disc list-inside opacity-90 text-xs sm:text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('guest.register') }}" enctype="multipart/form-data" id="registrationForm" class="space-y-6 sm:space-y-8">
                @csrf

                <!-- Section 1: Informasi Pribadi -->
                <div class="form-section space-y-5 sm:space-y-6" id="section1">
                    <div class="grid grid-cols-1 gap-5 sm:gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <label for="nama_pelapor" class="text-sm font-bold text-surface-700">Nama Lengkap</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                                    <i data-lucide="user" class="h-5 w-5"></i>
                                </div>
                                <input type="text" id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor') }}" required autocomplete="name" class="block w-full rounded-2xl border border-surface-200 bg-white py-3 sm:py-4 pl-12 pr-4 text-sm sm:text-base text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="Nama sesuai KTP">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="no_hp" class="text-sm font-bold text-surface-700">Nomor WhatsApp</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                                    <i data-lucide="phone" class="h-5 w-5"></i>
                                </div>
                                <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required autocomplete="tel" class="block w-full rounded-2xl border border-surface-200 bg-white py-3 sm:py-4 pl-12 pr-4 text-sm sm:text-base text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="Contoh: 0812...">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="nik" class="text-sm font-bold text-surface-700">NIK (16 Digit)</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                                    <i data-lucide="id-card" class="h-5 w-5"></i>
                                </div>
                                <input type="text" id="nik" name="nik" value="{{ old('nik') }}" required class="block w-full rounded-2xl border border-surface-200 bg-white py-3 sm:py-4 pl-12 pr-4 text-sm sm:text-base text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="16 digit NIK">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="nip" class="text-sm font-bold text-surface-700">NIP</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                                    <i data-lucide="badge-check" class="h-5 w-5"></i>
                                </div>
                                <input type="text" id="nip" name="nip" value="{{ old('nip') }}" required class="block w-full rounded-2xl border border-surface-200 bg-white py-3 sm:py-4 pl-12 pr-4 text-sm sm:text-base text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="NIP Anda">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-5 sm:space-y-6">
                        <div class="space-y-2">
                            <label for="jenis_instansi" class="text-sm font-bold text-surface-700">Jenis Instansi</label>
                            <select name="jenis_instansi" id="jenis_instansi" required class="block w-full rounded-2xl border border-surface-200 bg-white py-3 sm:py-4 px-4 text-sm sm:text-base text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10 appearance-none">
                                <option value="">Pilih Jenis Instansi</option>
                                <option value="provinsi">Pemerintah Provinsi Aceh</option>
                                <option value="kabupaten">Pemerintah Kabupaten / Kota</option>
                            </select>
                        </div>

                        <div id="asal_instansi_container" class="hidden space-y-2">
                            <label for="asal_instansi" class="text-sm font-bold text-surface-700">Asal Kabupaten / Kota</label>
                            <select name="asal_instansi" id="asal_instansi" class="block w-full rounded-2xl border border-surface-200 bg-white py-3 sm:py-4 px-4 text-sm sm:text-base text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10 appearance-none">
                                <option value="">Pilih Kabupaten / Kota</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="instansi" class="text-sm font-bold text-surface-700">Satuan Kerja / Instansi</label>
                            <select name="instansi" id="instansi" disabled required class="block w-full rounded-2xl border border-surface-200 bg-surface-50 py-3 sm:py-4 px-4 text-sm sm:text-base text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10 appearance-none disabled:opacity-50">
                                <option value="">Pilih Instansi</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="button" class="next-btn flex w-full items-center justify-center space-x-2 rounded-2xl bg-primary-600 py-3 sm:py-4 text-base sm:text-lg font-bold text-white shadow-xl shadow-primary-600/20 transition-all hover:bg-primary-700 active:scale-[0.98]">
                            <span>Lanjut ke Dokumen</span>
                            <i data-lucide="chevron-right" class="h-5 w-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Section 2: Dokumen -->
                <div class="form-section hidden space-y-6 sm:space-y-8" id="section2">
                    <div class="space-y-5 sm:space-y-6">
                        <div class="space-y-3">
                            <label class="text-sm font-bold text-surface-700">Surat Pernyataan Pengelola (PDF)</label>
                            <div class="group relative flex flex-col items-center justify-center rounded-3xl border-2 border-dashed border-surface-200 bg-surface-50 p-8 sm:p-10 transition-all hover:border-primary-400 hover:bg-primary-50/30 text-center">
                                <input type="file" id="surat_pernyataan_pengelola" name="surat_pernyataan_pengelola" accept=".pdf" required class="absolute inset-0 cursor-pointer opacity-0 z-10 w-full h-full">
                                <div class="flex h-14 w-14 sm:h-16 sm:w-16 items-center justify-center rounded-2xl bg-white text-primary-600 shadow-sm group-hover:scale-110 transition-transform">
                                    <i data-lucide="file-up" class="h-6 w-6 sm:h-8 sm:w-8"></i>
                                </div>
                                <p id="suratFileName" class="mt-4 text-xs sm:text-sm font-medium text-surface-600">Klik atau seret file PDF di sini</p>
                                <p class="text-[9px] sm:text-[10px] text-surface-400 mt-1 uppercase tracking-wider">Maksimal 2MB</p>
                            </div>
                            <a href="{{ route('guest.download.template') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-primary-600 hover:underline">
                                <i data-lucide="download" class="h-3 w-3"></i>
                                <span>Unduh Template Surat</span>
                            </a>
                        </div>

                        <div class="space-y-3">
                            <label class="text-sm font-bold text-surface-700">Foto KTP (Format Gambar)</label>
                            <div class="group relative flex flex-col items-center justify-center rounded-3xl border-2 border-dashed border-surface-200 bg-surface-50 p-8 sm:p-10 transition-all hover:border-primary-400 hover:bg-primary-50/30 text-center">
                                <input type="file" id="ktp" name="ktp" accept=".jpg,.jpeg,.png" required class="absolute inset-0 cursor-pointer opacity-0 z-10 w-full h-full">
                                <div class="flex h-14 w-14 sm:h-16 sm:w-16 items-center justify-center rounded-2xl bg-white text-primary-600 shadow-sm group-hover:scale-110 transition-transform">
                                    <i data-lucide="image-plus" class="h-6 w-6 sm:h-8 sm:w-8"></i>
                                </div>
                                <p id="ktpFileName" class="mt-4 text-xs sm:text-sm font-medium text-surface-600">Klik atau seret foto KTP di sini</p>
                                <p class="text-[9px] sm:text-[10px] text-surface-400 mt-1 uppercase tracking-wider">JPG, JPEG, atau PNG (Maks 2MB)</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-3 sm:space-x-4 pt-6">
                        <button type="button" class="prev-btn flex-1 items-center justify-center rounded-2xl bg-surface-100 py-3 sm:py-4 text-sm sm:text-base font-bold text-surface-600 transition-all hover:bg-surface-200">
                            Kembali
                        </button>
                        <button type="button" class="next-btn flex-[2] items-center justify-center space-x-2 rounded-2xl bg-primary-600 py-3 sm:py-4 text-sm sm:text-base font-bold text-white shadow-xl shadow-primary-600/20 transition-all hover:bg-primary-700">
                            <span>Lanjut</span>
                            <i data-lucide="chevron-right" class="h-5 w-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Section 3: Keamanan -->
                <div class="form-section hidden space-y-6 sm:space-y-8" id="section3">
                    <div class="space-y-5 sm:space-y-6">
                        <div class="space-y-2">
                            <label for="password" class="text-sm font-bold text-surface-700">Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                                    <i data-lucide="lock" class="h-5 w-5"></i>
                                </div>
                                <input type="password" id="password" name="password" required autocomplete="new-password" class="block w-full rounded-2xl border border-surface-200 bg-white py-3 sm:py-4 pl-12 pr-12 text-sm sm:text-base text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="Minimal 8 karakter">
                                <button type="button" class="toggle-pass absolute inset-y-0 right-0 flex items-center pr-4 text-surface-400 hover:text-surface-600">
                                    <i data-lucide="eye" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="text-sm font-bold text-surface-700">Konfirmasi Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 text-surface-400 group-focus-within:text-primary-600 transition-colors">
                                    <i data-lucide="shield-check" class="h-5 w-5"></i>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" class="block w-full rounded-2xl border border-surface-200 bg-white py-3 sm:py-4 pl-12 pr-12 text-sm sm:text-base text-surface-900 outline-none transition-all focus:border-primary-600 focus:ring-4 focus:ring-primary-600/10" placeholder="Ulangi password">
                            </div>
                        </div>

                        <label class="flex cursor-pointer items-start space-x-3 rounded-2xl bg-surface-50 p-4 transition-all hover:bg-surface-100 border border-transparent focus-within:border-primary-600">
                            <input type="checkbox" name="terms" required class="mt-1 h-4 w-4 sm:h-5 sm:w-5 rounded border-surface-300 text-primary-600 focus:ring-primary-600">
                            <span class="text-xs sm:text-sm font-medium text-surface-600 leading-relaxed">
                                Saya menyatakan bahwa data yang saya berikan adalah benar dan saya menyetujui <a href="#" class="font-bold text-primary-600 hover:underline">Syarat & Ketentuan</a> layanan.
                            </span>
                        </label>
                    </div>

                    <div class="flex space-x-3 sm:space-x-4 pt-6">
                        <button type="button" class="prev-btn flex-1 items-center justify-center rounded-2xl bg-surface-100 py-3 sm:py-4 text-sm sm:text-base font-bold text-surface-600 transition-all hover:bg-surface-200">
                            Kembali
                        </button>
                        <button type="submit" class="flex-[2] flex items-center justify-center space-x-2 rounded-2xl bg-primary-600 py-3 sm:py-4 text-sm sm:text-base font-bold text-white shadow-xl shadow-primary-600/20 transition-all hover:bg-primary-700">
                            <span>Daftar</span>
                            <i data-lucide="check-circle" class="h-5 w-5 hidden sm:block"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Bottom Links -->
            <div class="mt-10 sm:mt-12 flex items-center justify-center space-x-4 sm:space-x-6 border-t border-surface-100 pt-6 sm:pt-8">
                <p class="text-xs sm:text-sm text-surface-500">Sudah punya akun? <a href="{{ route('guest.login') }}" class="font-bold text-primary-600 hover:underline">Masuk</a></p>
                <div class="h-1 w-1 rounded-full bg-surface-300"></div>
                <a href="{{ route('landing') }}" class="text-xs sm:text-sm font-semibold text-surface-400 hover:text-surface-600">Beranda</a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Animation (Faster)
        anime({
            targets: '.register-card',
            translateY: [20, 0],
            opacity: [0, 1],
            duration: 600,
            easing: 'easeOutQuart'
        });

        const sections = document.querySelectorAll('.form-section');
        const steps = document.querySelectorAll('.step-item');
        const progressBar = document.getElementById('step-progress');
        const nextBtns = document.querySelectorAll('.next-btn');
        const prevBtns = document.querySelectorAll('.prev-btn');
        let currentStep = 0;

        const updateUI = () => {
            sections.forEach((s, i) => s.classList.toggle('hidden', i !== currentStep));
            steps.forEach((s, i) => {
                s.classList.toggle('active', i === currentStep);
                s.classList.toggle('border-primary-600', i <= currentStep);
                s.classList.toggle('text-primary-600', i <= currentStep);
            });
            progressBar.style.width = `${(currentStep / (steps.length - 1)) * 100}%`;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };

        nextBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const inputs = sections[currentStep].querySelectorAll('input[required], select[required]');
                let valid = true;
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('border-red-400', 'bg-red-50');
                        valid = false;
                    } else {
                        input.classList.remove('border-red-400', 'bg-red-50');
                    }
                });
                if (valid && currentStep < sections.length - 1) {
                    currentStep++;
                    updateUI();
                }
            });
        });

        prevBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    updateUI();
                }
            });
        });

        // File names
        document.getElementById('surat_pernyataan_pengelola').addEventListener('change', e => {
            document.getElementById('suratFileName').textContent = e.target.files[0]?.name || 'Pilih file PDF';
        });
        document.getElementById('ktp').addEventListener('change', e => {
            document.getElementById('ktpFileName').textContent = e.target.files[0]?.name || 'Pilih foto KTP';
        });

        // Password Toggles
        document.querySelectorAll('.toggle-pass').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = btn.previousElementSibling;
                const isPass = input.type === 'password';
                input.type = isPass ? 'text' : 'password';
                btn.innerHTML = `<i data-lucide="${isPass ? 'eye-off' : 'eye'}" class="h-5 w-5"></i>`;
                lucide.createIcons();
            });
        });

        // ApiDinas Logic
        const jenisInstansi = document.getElementById('jenis_instansi');
        const asalInstansiContainer = document.getElementById('asal_instansi_container');
        const asalInstansi = document.getElementById('asal_instansi');
        const instansi = document.getElementById('instansi');

        fetch('/guest/api/asal-instansi')
            .then(res => res.json())
            .then(data => {
                if(data.status && data.data) {
                    data.data.forEach(item => {
                        if(item.toLowerCase() !== 'provinsi') {
                            const opt = new Option(item, item);
                            asalInstansi.add(opt);
                        }
                    });
                }
            });

        jenisInstansi.addEventListener('change', function() {
            instansi.innerHTML = '<option value="">Pilih Instansi</option>';
            instansi.disabled = true;
            instansi.classList.replace('bg-white', 'bg-surface-50');

            if (this.value === 'kabupaten') {
                asalInstansiContainer.classList.remove('hidden');
                asalInstansi.required = true;
            } else if (this.value === 'provinsi') {
                asalInstansiContainer.classList.add('hidden');
                asalInstansi.required = false;
                fetchInstansi('Provinsi');
            } else {
                asalInstansiContainer.classList.add('hidden');
            }
        });

        asalInstansi.addEventListener('change', function() {
            if (this.value) fetchInstansi(this.value);
            else {
                instansi.innerHTML = '<option value="">Pilih Instansi</option>';
                instansi.disabled = true;
            }
        });

        function fetchInstansi(kab) {
            instansi.innerHTML = '<option value="">Memuat data...</option>';
            instansi.disabled = true;
            fetch(`/guest/api/instansi?kabupaten=${encodeURIComponent(kab)}`)
                .then(res => res.json())
                .then(data => {
                    instansi.innerHTML = '<option value="">Pilih Instansi</option>';
                    if(data.status && data.SKPA) {
                        data.SKPA.forEach(item => instansi.add(new Option(item.nama_skpa, item.nama_skpa)));
                        instansi.disabled = false;
                        instansi.classList.replace('bg-surface-50', 'bg-white');
                    }
                });
        }
    });
</script>
@endpush
