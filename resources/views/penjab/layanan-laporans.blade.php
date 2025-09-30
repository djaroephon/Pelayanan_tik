<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laporan Layanan - {{ $layanan->nama_penjab_layanan }}</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #6c8aff;
            --primary-dark: #3a56d4;
            --secondary: #6c757d;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-600: #6c757d;
            --gray-800: #343a40;
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --gradient-4: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e7ec 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            color: var(--gray-800);
            line-height: 1.6;
        }

        /* Sidebar Enhanced */
        .sidebar {
            height: 100vh;
            background: var(--gradient-1);
            color: #fff;
            position: fixed;
            width: 280px;
            top: 0;
            left: 0;
            overflow-y: auto;
            z-index: 1055;
            transition: all 0.3s ease-in-out;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
            pointer-events: none;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 0.85rem 1.25rem;
            border-radius: 12px;
            margin: 0.2rem 0.75rem;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link i {
            width: 24px;
            text-align: center;
            margin-right: 0.75rem;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            transform: translateX(8px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .sidebar .dropdown-item {
            color: var(--gray-800);
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            margin: 0.1rem 0.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar .dropdown-item:hover,
        .sidebar .dropdown-item.active {
            background: var(--primary);
            color: white;
            transform: translateX(5px);
        }

        /* User Info Enhanced */
        .user-info {
            padding: 1.5rem 1rem;
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .user-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
            transition: margin-left 0.3s ease-in-out;
            min-height: 100vh;
        }

        /* Page Title Enhanced */
        .page-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 1.5rem;
            font-weight: 800;
            color: var(--gray-800);
            background: linear-gradient(135deg, var(--gray-800) 0%, var(--primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .page-title::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100px;
            height: 4px;
            background: var(--gradient-3);
            border-radius: 2px;
        }

        /* Info Card Enhanced */
        .info-card {
            border: none;
            border-radius: 20px;
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gradient-3);
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .info-card .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .info-card .card-body {
            padding: 1.5rem;
        }

        /* Table Enhanced */
        .table-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%) !important;
            color: white;
            font-weight: 700;
            padding: 1.25rem 1rem;
            border: none;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
        }

        .table thead th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: rgba(255,255,255,0.3);
        }

        .table tbody td {
            padding: 1.25rem 1rem;
            vertical-align: middle;
            border-color: rgba(0, 0, 0, 0.05);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .table-hover tbody tr {
            transition: all 0.3s ease;
        }

        .table-hover tbody tr:hover {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.03) 0%, rgba(67, 97, 238, 0.08) 100%);
            transform: scale(1.01);
        }

        /* Badges Enhanced */
        .status-badge {
            padding: 0.6em 1.2em;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            min-width: 100px;
            display: inline-block;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .status-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
        }

        .badge-pending {
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
            color: #d63031;
            border: none;
        }

        .badge-progress {
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
            color: #0984e3;
            border: none;
        }

        .badge-complete {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            color: #00b894;
            border: none;
        }

        /* Buttons Enhanced */
        .btn {
            border-radius: 12px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            border: none;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.5s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: var(--gradient-1);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(67, 97, 238, 0.4);
        }

        .btn-outline-primary {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
        }

        /* Empty State Enhanced */
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
            color: var(--gray-600);
        }

        .empty-state i {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            opacity: 0.3;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .empty-state h4 {
            margin-bottom: 1rem;
            font-weight: 700;
            color: var(--gray-800);
        }

        /* Footer Enhanced */
        .footer {
            text-align: center;
            padding: 2rem;
            color: var(--gray-600);
            font-size: 0.9rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 20px;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Mobile Header */
        .mobile-header {
            display: none;
            background: #fff;
            padding: 1rem 1.5rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--gray-200);
        }

        #toggleSidebar {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary);
            transition: transform 0.3s ease;
        }

        #toggleSidebar:hover {
            transform: rotate(90deg);
        }

        /* Backdrop (mobile) */
        #sidebarBackdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            backdrop-filter: blur(3px);
        }

        #sidebarBackdrop.show {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 1.5rem 1rem;
            }

            .mobile-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Layanan Info */
        .layanan-info {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .layanan-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--gradient-1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-right: 1.5rem;
        }
    </style>
</head>
<body>
<div id="sidebarBackdrop"></div>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 px-0 sidebar" aria-label="Sidebar navigasi">
            <div class="d-flex flex-column p-3">
                <div class="user-info">
                    <div class="d-flex align-items-center mb-2">
                        <div class="position-relative me-3">
                            <i class="fas fa-user-tie fa-2x"></i>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                                <span class="visually-hidden">Online</span>
                            </span>
                        </div>
                        <div>
                            <h5 class="m-0">{{ Auth::user()->name }}</h5>
                            <small class="layanan-name">
                                @if($penjabLayanans->count() > 0)
                                    Mengelola {{ $penjabLayanans->count() }} Layanan
                                @else
                                    Belum ada layanan
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="{{ route('penjab.dashboard') }}" class="nav-link">
                            <i class="fa-solid fa-house-user"></i> <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Dropdown Layanan Saya -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-list"></i> <span>Layanan Saya</span>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($penjabLayanans as $item)
                            <li>
                                <a class="dropdown-item {{ $item->id == $layanan->id ? 'active' : '' }}"
                                   href="{{ route('penjab.layanan.detail', $item->id) }}">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                <i class="fas fa-layer-group text-primary" style="font-size: 0.8rem;"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="fw-semibold">{{ $item->nama_penjab_layanan }}</div>
                                            <small class="text-muted">{{ $item->laporans_count }} laporan</small>
                                        </div>
                                        @if($item->id == $layanan->id)
                                            <i class="fas fa-chevron-right text-primary ms-2"></i>
                                        @endif
                                    </div>
                                </a>
                            </li>
                            @endforeach
                            @if($penjabLayanans->isEmpty())
                            <li><a class="dropdown-item text-muted" href="#"><i class="fas fa-info-circle me-2"></i>Belum ada layanan</a></li>
                            @endif
                        </ul>
                    </li>

                    <li class="nav-item mt-5">
                        <a href="{{ route('logout') }}" class="nav-link"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>


            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 col-lg-10 main-content">
            <!-- Mobile Header -->
            <div class="mobile-header">
                <button id="toggleSidebar" aria-label="Buka/tutup sidebar" title="Toggle Sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0">Laporan Layanan</h5>
                <div class="d-flex align-items-center">
                    <span class="badge bg-primary me-2">Online</span>
                    <i class="fas fa-bell text-muted"></i>
                </div>
            </div>

            <!-- Desktop Header -->
            <div class="d-none d-lg-flex justify-content-between align-items-center mb-4 flex-wrap gap-3 fade-in-up">
                <div>
                    <h1 class="h2 mb-0 page-title">Laporan Layanan: {{ $layanan->nama_penjab_layanan }}</h1>
                    <p class="text-muted mb-0">Daftar semua laporan untuk layanan ini</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('penjab.layanan.detail', $layanan->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Detail
                    </a>
                </div>
            </div>

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4 fade-in-up" style="animation-delay: 0.1s;">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('penjab.dashboard') }}"><i class="fas fa-home me-1"></i>Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('penjab.layanan.detail', $layanan->id) }}">{{ $layanan->nama_penjab_layanan }}</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
            </nav>

            <!-- Layanan Info -->
            <div class="layanan-info fade-in-up" style="animation-delay: 0.2s;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div class="layanan-icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <div>
                                <h4 class="mb-1">{{ $layanan->nama_penjab_layanan }}</h4>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-info-circle me-2"></i>{{ $layanan->deskripsi ?? 'Tidak ada deskripsi' }}
                                </p>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-calendar me-2"></i>Dibuat: {{ $layanan->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="row g-2">
                            <div class="col-4">
                                <div class="text-center p-3 bg-primary bg-opacity-10 rounded-3">
                                    <h5 class="mb-0 text-primary">{{ $laporans->total() }}</h5>
                                    <small class="text-muted">Total</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center p-3 bg-warning bg-opacity-10 rounded-3">
                                    <h5 class="mb-0 text-warning">
                                        {{ $laporans->whereIn('status', ['pending', 'on progress'])->count() }}
                                    </h5>
                                    <small class="text-muted">Aktif</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center p-3 bg-success bg-opacity-10 rounded-3">
                                    <h5 class="mb-0 text-success">
                                        {{ $laporans->where('status', 'complete')->count() }}
                                    </h5>
                                    <small class="text-muted">Selesai</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Laporan Table -->
            <div class="info-card fade-in-up" style="animation-delay: 0.3s;">
                <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-semibold">Daftar Laporan ({{ $laporans->total() }})</h6>
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-sm btn-outline-secondary" id="refreshBtn" title="Refresh" aria-label="Refresh">
                            <i class="fas fa-rotate-right"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($laporans->isEmpty())
                        <div class="empty-state">
                            <i class="fas fa-clipboard-list"></i>
                            <h4 class="mb-1">Tidak ada laporan</h4>
                            <p class="mb-0">Belum ada laporan untuk layanan ini.</p>
                        </div>
                    @else
                        <div class="table-container">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                <tr>
                                    <th style="width:60px;">#</th>
                                    <th>Nama Pelapor</th>
                                    <th>Kategori</th>
                                    <th>Teknisi</th>
                                    <th>Permasalahan</th>
                                    <th style="width:150px;">Tanggal</th>
                                    <th style="width:120px;">Status</th>
                                    <th style="width:100px;">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($laporans as $laporan)
                                    <tr>
                                        <td>
                                            <div class="bg-light text-dark rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px;">
                                                {{ $loop->iteration + ($laporans->currentPage() - 1) * $laporans->perPage() }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $laporan->nama_pelapor }}</div>
                                            <small class="text-muted">
                                                <i class="fas fa-building me-1"></i>
                                                {{ $laporan->instansi }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge bg-info rounded-pill">
                                                {{ $laporan->kategori->nama_kategori ?? 'Tidak ada kategori' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($laporan->teknisis->count() > 0)
                                                <div class="d-flex flex-column">
                                                    @foreach($laporan->teknisis as $teknisi)
                                                        <span class="badge bg-primary mb-1">{{ $teknisi->nama_teknisi }}</span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="badge bg-secondary">Belum ada teknisi</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $fullText = $laporan->laporan_permasalahan;
                                                $shortText = \Illuminate\Support\Str::limit($fullText, 50);
                                            @endphp
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $fullText }}">
                                                {{ $shortText }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <div class="fw-semibold">{{ $laporan->created_at->format('d/m/Y') }}</div>
                                                <small class="text-muted">{{ $laporan->created_at->format('H:i') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if($laporan->status === 'pending')
                                                <span class="status-badge badge-pending">
                                                    <i class="fas fa-clock me-1"></i>Pending
                                                </span>
                                            @elseif($laporan->status === 'on progress')
                                                <span class="status-badge badge-progress">
                                                    <i class="fas fa-spinner me-1 fa-spin"></i>Proses
                                                </span>
                                            @elseif($laporan->status === 'complete')
                                                <span class="status-badge badge-complete">
                                                    <i class="fas fa-check me-1"></i>Selesai
                                                </span>
                                            @else
                                                <span class="status-badge badge-pending">{{ ucfirst($laporan->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('penjab.laporan.detail', $laporan->id) }}"
                                               class="btn btn-sm btn-primary btn-action">
                                                <i class="fas fa-eye me-1"></i>
                                                <span>Detail</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($laporans->hasPages())
                        <div class="d-flex justify-content-between align-items-center p-3 border-top">
                            <div class="text-muted small">
                                Menampilkan {{ $laporans->firstItem() }} - {{ $laporans->lastItem() }} dari {{ $laporans->total() }} laporan
                            </div>
                            <div>
                                {{ $laporans->links() }}
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="footer fade-in-up" style="animation-delay: 0.4s;">
                <p class="mb-0">
                    <strong>Diskominsa Aceh</strong> &copy; 2025 All rights reserved.

                </p>
            </div>
        </main>
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("toggleSidebar");
        const sidebar = document.querySelector(".sidebar");
        const backdrop = document.getElementById("sidebarBackdrop");

        function closeSidebar(){
            sidebar.classList.remove("show");
            backdrop.classList.remove("show");
        }

        function openSidebar(){
            sidebar.classList.add("show");
            backdrop.classList.add("show");
        }

        if(toggleBtn){
            toggleBtn.addEventListener("click", function () {
                sidebar.classList.contains("show") ? closeSidebar() : openSidebar();
            });
        }

        if(backdrop) {
            backdrop.addEventListener("click", closeSidebar);
        }

        window.addEventListener("resize", function () {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        });

        const refreshBtn = document.getElementById('refreshBtn');
        if (refreshBtn){
            refreshBtn.addEventListener('click', function(){
                const icon = this.querySelector('i');
                icon.className = 'fas fa-spinner fa-spin';

                setTimeout(() => {
                    window.location.reload();
                }, 800);
            });
        }

        // Enable tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Add scroll animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => {
            observer.observe(el);
        });

        // Close sidebar when nav link is clicked on mobile
        const navLinks = document.querySelectorAll('.sidebar .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 992) {
                    closeSidebar();
                }
            });
        });
    });
</script>
</body>
</html>
