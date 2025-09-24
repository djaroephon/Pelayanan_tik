<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Penjab Layanan</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        :root{
            --primary:#4361ee;
            --secondary:#6c757d;
            --success:#28a745;
            --warning:#ffc107;
            --danger:#dc3545;
            --light:#f8f9fa;
            --dark:#343a40;
        }

        body{
            background:#f5f7fa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar */
        .sidebar{
            height:100vh;
            background:linear-gradient(180deg, var(--primary), #3a56d4);
            color:#fff;
            position:fixed;
            width:250px;
            top:0; left:0;
            overflow-y:auto;
            z-index:1055;
            transition:transform .3s ease-in-out;
        }
        .sidebar .nav-link{
            color:rgba(255,255,255,.9);
            padding:.85rem 1.25rem;
            border-radius:.5rem;
            margin:.2rem .75rem;
            transition:all .2s;
        }
        .sidebar .nav-link i{ width:24px; text-align:center; margin-right:.5rem;}
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active{
            background:rgba(255,255,255,.15);
            color:#fff;
        }

        /* Content */
        .main-content{
            margin-left:250px;
            padding:1.5rem;
            transition:margin-left .3s ease-in-out;
        }

        .mobile-header{
            display:none;
            background:#fff;
            padding:1rem;
            box-shadow:0 2px 4px rgba(0,0,0,.06);
            position:sticky; top:0; z-index:100;
        }
        #toggleSidebar{
            background:none; border:none; font-size:1.5rem; color:var(--primary);
        }

        /* Backdrop (mobile) */
        #sidebarBackdrop{
            display:none;
            position:fixed; inset:0;
            background:rgba(0,0,0,.4);
            z-index:1050;
        }
        #sidebarBackdrop.show{ display:block; }

        /* Stat cards */
        .stat-card{
            border:none; border-radius:16px; color:#fff; padding:1.25rem 1.25rem 1.1rem;
            position:relative; overflow:hidden;
            box-shadow:0 8px 18px rgba(0,0,0,.08);
            transition:transform .25s ease, box-shadow .25s ease;
        }
        .stat-card:hover{ transform:translateY(-4px); box-shadow:0 16px 28px rgba(0,0,0,.12); }
        .stat-card .icon{
            position:absolute; right:16px; top:14px; font-size:2.4rem; opacity:.18;
        }
        .bg-grad-primary{ background:linear-gradient(135deg, #4361ee, #3a56d4);}
        .bg-grad-warning{ background:linear-gradient(135deg, #ffc107, #e0a800);}
        .bg-grad-success{ background:linear-gradient(135deg, #28a745, #218838);}

        /* Badges status */
        .status-badge{ padding:.45em .8em; border-radius:999px; font-size:.85rem; font-weight:600; min-width:90px; display:inline-block; text-align:center;}
        .badge-pending{ background:#e9ecef; color:#495057;}
        .badge-progress{ background:#fff3cd; color:#856404;}
        .badge-complete{ background:#d4edda; color:#155724;}

        /* Table */
        .table-responsive{
            border-radius:12px; overflow:auto;
            box-shadow:0 4px 10px rgba(0,0,0,.05);
            background:#fff;
        }
        .table thead th{
            position:sticky; top:0;
            background:#f8f9fa !important;
            color:var(--primary); font-weight:700; z-index:2;
        }
        .table-hover tbody tr:hover{ background:rgba(67,97,238,.06); }
        .table-striped > tbody > tr:nth-of-type(odd) > * { background-color: rgba(0,0,0,.015); }

        /* Page title underline */
        .page-title{ position:relative; padding-bottom:10px; margin-bottom:1rem;}
        .page-title::after{
            content:""; position:absolute; left:0; bottom:0; width:60px; height:4px;
            background:var(--primary); border-radius:2px;
        }

        /* Responsive table columns (hide on small) */
        .col-hidden{ display:none; }
        @media (min-width: 992px){
            .col-hidden{ display:table-cell; }
        }

        /* Desktop vs Mobile */
        @media (max-width: 991.98px){
            .sidebar{ transform:translateX(-100%); width:220px; }
            .sidebar.show{ transform:translateX(0); }
            .main-content{ margin-left:0; padding:1rem; }
            .mobile-header{ display:flex; align-items:center; justify-content:space-between; }
        }

        /* Compact action btn on mobile */
        @media (max-width:576px){
            .btn-action span{ display:none; }
            .btn-action i{ margin-right:0; }
        }

        .user-info {
            padding: 1rem;
            border-bottom: 1px solid rgba(255,255,255,.1);
            margin-bottom: 1rem;
        }
        .user-info h5 {
            margin-bottom: 0.2rem;
        }
        .user-info .layanan-name {
            font-size: 0.85rem;
            opacity: 0.8;
        }

        /* Layanan card styles */
        .layanan-card {
            border-left: 4px solid var(--primary);
            transition: all 0.3s ease;
        }
        .layanan-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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
                        <i class="fas fa-user-tie fa-2x me-2"></i>
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
                        <a href="{{ route('penjab.dashboard') }}" class="nav-link active">
                            <i class="fa-solid fa-house-user"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penjab.layanan') }}" class="nav-link">
                            <i class="fas fa-list"></i> <span>Layanan Saya</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penjab.laporan') }}" class="nav-link">
                            <i class="fas fa-clipboard-list"></i> <span>Laporan</span>
                        </a>
                    </li>
                    <li class="nav-item mt-4">
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

        <!-- Main -->
        <main class="col-md-9 col-lg-10 main-content">
            <!-- Mobile Header -->
            <div class="mobile-header">
                <button id="toggleSidebar" aria-label="Buka/tutup sidebar" title="Toggle Sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0">Dashboard Penjab</h5>
                <div></div>
            </div>

            <!-- Desktop Header -->
            <div class="d-none d-lg-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <h1 class="h2 mb-0 page-title">Dashboard Penjab Layanan</h1>
                    <p class="text-muted mb-0">Ringkasan layanan dan laporan yang menjadi tanggung jawab Anda</p>
                </div>
                <div class="search-container flex-grow-1" style="max-width: 320px;">
                    <form action="#" method="GET" role="search" aria-label="Pencarian laporan">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari laporan..." name="q" />
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            @if($penjabLayanans->isEmpty())
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Anda belum memiliki layanan yang ditugaskan. Silakan hubungi administrator.
                </div>
            @else
                <!-- Stat Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="stat-card bg-grad-primary">
                            <div class="card-body">
                                <h5 class="card-title mb-1">Layanan Saya</h5>
                                <p class="fs-2 fw-bold mb-0">{{ $totalLayanan }}</p>
                                <p class="mb-0"><small>Total layanan yang dikelola</small></p>
                                <i class="fas fa-list icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="stat-card bg-grad-warning">
                            <div class="card-body">
                                <h5 class="card-title mb-1">Laporan Aktif</h5>
                                <p class="fs-2 fw-bold mb-0">{{ $laporanAktif }}</p>
                                <p class="mb-0"><small>Laporan yang sedang diproses</small></p>
                                <i class="fas fa-tasks icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="stat-card bg-grad-success">
                            <div class="card-body">
                                <h5 class="card-title mb-1">Selesai</h5>
                                <p class="fs-2 fw-bold mb-0">{{ $laporanSelesai }}</p>
                                <p class="mb-0"><small>Laporan selesai bulan ini</small></p>
                                <i class="fas fa-check-circle icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Layanan Saya Section -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-semibold">Layanan Saya ({{ $penjabLayanans->count() }})</h6>
                        <a href="{{ route('penjab.layanan') }}" class="btn btn-sm btn-outline-primary">Kelola Layanan</a>
                    </div>
                    <div class="card-body p-0">
                        @if($penjabLayanans->isEmpty())
                            <div class="p-5 text-center text-muted">
                                <i class="fas fa-clipboard-list mb-3" style="font-size:4rem; color:#dee2e6;"></i>
                                <h4 class="mb-1">Belum ada layanan</h4>
                                <p class="mb-0">Anda belum memiliki layanan yang dikelola.</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover table-striped align-middle mb-0">
                                    <thead>
                                    <tr>
                                        <th style="width:48px;">#</th>
                                        <th>Nama Layanan</th>
                                        <th style="width:120px;">Jumlah Laporan</th>
                                        {{-- <th style="width:110px;">Aksi</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($penjabLayanans as $layanan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $layanan->nama_penjab_layanan }}</strong>
                                            </td>

                                            <td>
                                                <span class="badge bg-primary w-50 h-50">{{ $layanan->laporans_count ?? 0 }}</span>
                                            </td>
                                            {{-- <td>
                                                <a href="{{ route('penjab.layanan.detail', $layanan->id) }}"
                                                   class="btn btn-sm btn-primary btn-action">
                                                    <i class="fas fa-eye me-1"></i>
                                                    <span>Detail</span>
                                                </a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Teknisi Section -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-semibold">Teknisi yang Ditugaskan</h6>
                        <span class="badge bg-primary">{{ $teknisis->count() }} Teknisi</span>
                    </div>
                    <div class="card-body p-0">
                        @if($teknisis->isEmpty())
                            <div class="p-5 text-center text-muted">
                                <i class="fas fa-users mb-3" style="font-size:4rem; color:#dee2e6;"></i>
                                <h4 class="mb-1">Belum ada teknisi</h4>
                                <p class="mb-0">Belum ada teknisi yang ditugaskan pada layanan Anda.</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover table-striped align-middle mb-0">
                                    <thead>
                                    <tr>
                                        <th style="width:48px;">#</th>
                                        <th>Nama Teknisi</th>
                                        <th class="col-hidden">No HP</th>
                                        <th style="width:120px;">Jumlah Laporan</th>
                                        <th style="width:110px;">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($teknisis as $teknisi)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $teknisi->nama_teknisi }}</td>
                                            <td class="col-hidden">{{ $teknisi->no_hp_teknisi }}</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $teknisi->laporans_count }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Aktif</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Laporan Terbaru Section -->
                <div class="card shadow border-0">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-semibold">Laporan Terbaru</h6>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('penjab.laporan') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                            <button class="btn btn-sm btn-outline-secondary" id="refreshBtn" title="Refresh" aria-label="Refresh">
                                <i class="fas fa-rotate-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if($laporans->isEmpty())
                            <div class="p-5 text-center text-muted">
                                <i class="fas fa-clipboard-list mb-3" style="font-size:4rem; color:#dee2e6;"></i>
                                <h4 class="mb-1">Tidak ada laporan</h4>
                                <p class="mb-0">Saat ini tidak ada laporan yang terkait dengan layanan Anda.</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover table-striped align-middle mb-0">
                                    <thead>
                                    <tr>
                                        <th style="width:48px;">#</th>
                                        <th>Pelapor</th>
                                        <th class="col-hidden">Instansi</th>
                                        <th>Permasalahan</th>
                                        <th class="col-hidden">Layanan</th>
                                        <th style="width:120px;">Tanggal</th>
                                        <th style="width:120px;">Status</th>
                                        <th style="width:110px;">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($laporans as $laporan)
                                        @php
                                            $penyelesaian = $laporan->penyelesaian;
                                            $layanan = $penyelesaian ? $penyelesaian->penjabLayanan : null;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $laporan->nama_pelapor }}</td>
                                            <td class="col-hidden">{{ $laporan->instansi }}</td>
                                            <td>
                                                @php
                                                    $fullText = $laporan->laporan_permasalahan;
                                                    $shortText = \Illuminate\Support\Str::limit($fullText, 40);
                                                @endphp
                                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $fullText }}">
                                                    {{ $shortText }}
                                                </span>
                                            </td>
                                            <td class="col-hidden">
                                                @if($layanan)
                                                    <span class="badge bg-info">{{ $layanan->nama_penjab_layanan }}</span>
                                                @else
                                                    <span class="badge bg-secondary">Belum ditugaskan</span>
                                                @endif
                                            </td>
                                            <td>{{ $laporan->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                @if($laporan->status === 'pending')
                                                    <span class="status-badge badge-pending">Pending</span>
                                                @elseif($laporan->status === 'on progress')
                                                    <span class="status-badge badge-progress">Proses</span>
                                                @elseif($laporan->status === 'complete')
                                                    <span class="status-badge badge-complete">Selesai</span>
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
                        @endif
                    </div>
                </div>
            @endif
        </main>
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("toggleSidebar");
        const sidebar = document.querySelector(".sidebar");
        const backdrop = document.getElementById("sidebarBackdrop");

        function closeSidebar(){ sidebar.classList.remove("show"); backdrop.classList.remove("show"); }
        function openSidebar(){ sidebar.classList.add("show"); backdrop.classList.add("show"); }

        if(toggleBtn){
            toggleBtn.addEventListener("click", function () {
                sidebar.classList.contains("show") ? closeSidebar() : openSidebar();
            });
        }
        backdrop.addEventListener("click", closeSidebar);

        window.addEventListener("resize", function () {
            if (window.innerWidth >= 992) { closeSidebar(); }
        });

        const refreshBtn = document.getElementById('refreshBtn');
        if (refreshBtn){
            refreshBtn.addEventListener('click', function(){
                window.location.reload();
            });
        }

        // Enable tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
</body>
</html>



