<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Lapor Masalah TIK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <style>
        * {
            font-family: "Poppins", sans-serif;
        }

        :root{
            --primary:#1c908d;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
        }

        .bg-ijo{
            background-color: var(--primary);
        }
    </style>
</head>
<body>
<div class="bg-ijo">
<div class="container py-5 fade-in">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">

            <div class="card p-4">
                <h2 class="text-center text-dark fw-bold mb-4">Formulir Laporan Masalah TIK</h2>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <script>
                            setTimeout(() => window.location.href = "{{ route('landing') }}", 2000);
                        </script>
                    </div>
                @endif

                @if($errors->any()))
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('lapor.submit') }}" class="needs-validation" novalidate>
                    @csrf

                    <!-- Nama Pelapor (auto dari guest) -->
                    <div class="mb-3">
                        <label class="form-label">Nama Pelapor</label>
                        <input
                            type="text"
                            name="nama_pelapor"
                            value="{{ $guest->nama_pelapor }}"
                            class="form-control"
                            readonly
                        >
                    </div>

                    <!-- Instansi (auto dari guest) -->
                    <div class="mb-3">
                        <label class="form-label">Instansi</label>
                        <input
                            type="text"
                            name="instansi"
                            value="{{ $guest->instansi }}"
                            class="form-control"
                            readonly
                        >
                    </div>

                     <div class="mb-3">
                        <label class="form-label">No HP Pelapor</label>
                        <input
                            type="text"
                            name="no_hp_pelapor"
                            value="{{ $guest->no_hp }}"
                            class="form-control"
                            readonly
                        >
                    </div>

                    @php
                        $fields = [
                            ['label' => 'Email Pelapor', 'name' => 'email_pelapor', 'type' => 'email', 'required' => false],
                            ['label' => 'Bidang / UPTD', 'name' => 'bidang', 'type' => 'text', 'required' => true],
                            ['label' => 'IP Jaringan', 'name' => 'ip_jaringan', 'type' => 'text', 'placeholder' => 'contoh: 192.168.1.1'],
                            ['label' => 'IP Server', 'name' => 'ip_server', 'type' => 'text', 'placeholder' => 'contoh: 192.168.1.100'],
                        ];
                    @endphp

                    @foreach($fields as $field)
                        <div class="mb-3">
                            <label class="form-label">{{ $field['label'] }}</label>
                            <input
                                type="{{ $field['type'] }}"
                                name="{{ $field['name'] }}"
                                value="{{ old($field['name']) }}"
                                class="form-control @error($field['name']) is-invalid @enderror"
                                {{ $field['required'] ?? false ? 'required' : '' }}
                                placeholder="{{ $field['placeholder'] ?? '' }}"
                            >
                            @error($field['name'])
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach

                    <div class="mb-3">
                        <label class="form-label">Kategori Laporan</label>
                        <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Waktu Permasalahan</label>
                        <input
                            type="datetime-local"
                            name="waktu_permasalahan"
                            value="{{ old('waktu_permasalahan') }}"
                            class="form-control @error('waktu_permasalahan') is-invalid @enderror"
                            required
                        >
                        @error('waktu_permasalahan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Laporan Permasalahan</label>
                        <textarea
                            name="laporan_permasalahan"
                            rows="4"
                            class="form-control @error('laporan_permasalahan') is-invalid @enderror"
                            required>{{ old('laporan_permasalahan') }}</textarea>
                        @error('laporan_permasalahan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('guest.home') }}" class="btn btn-outline-secondary">
                            ← Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Kirim Laporan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
