<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wilayah - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-content {
            padding: 20px;
            margin-left: 280px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: none;
        }
        .btn-primary {
            background: linear-gradient(45deg, #4361ee, #3a0ca3);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #3a56d4, #2a077c);
        }
    </style>
</head>
<body>
    @include('components.sidebar')

    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">Tambah Wilayah</h1>
            <div class="d-flex align-items-center">
                <span class="me-3">Hi, {{ Auth::user()->name }}</span>
                <div class="avatar bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                    <i class="fas fa-user text-white"></i>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white">
                <h5 class="fw-bold m-0"><i class="fas fa-plus-circle me-2"></i>Form Tambah Wilayah</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('wilayah.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_wilayah" class="form-label">Nama Wilayah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_wilayah') is-invalid @enderror"
                               id="nama_wilayah" name="nama_wilayah"
                               value="{{ old('nama_wilayah') }}"
                               placeholder="Contoh: Dishub, Disbudpar, dll." required>
                        @error('nama_wilayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ip_address" class="form-label">IP Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('ip_address') is-invalid @enderror"
                               id="ip_address" name="ip_address"
                               value="{{ old('ip_address') }}"
                               placeholder="Contoh: 123.108.98.1" required>
                        @error('ip_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pilih Teknisi</label>
                        <div class="row">
                            @foreach($teknisis as $teknisi)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           name="teknisi_ids[]"
                                           value="{{ $teknisi->id }}"
                                           id="teknisi{{ $teknisi->id }}"
                                           {{ in_array($teknisi->id, old('teknisi_ids', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="teknisi{{ $teknisi->id }}">
                                        <i class="fas fa-user-cog me-1 text-primary"></i>
                                        {{ $teknisi->nama_teknisi }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if($teknisis->isEmpty())
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Belum ada data teknisi. Silakan tambah teknisi terlebih dahulu.
                            </div>
                        @endif
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                        <a href="{{ route('wilayah.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
