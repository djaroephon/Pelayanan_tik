<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Layanan Teknisi - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #6c757d;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
        }

        body {
            background-color: #f5f7fa;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }


        #cacti{
            background-image:url({{ asset('images/layanan/cact.png') }}) ;
            background-size: cover;
            background-position: center;
        }

        #mail{
            background-image:url({{ asset('images/layanan/mail.png') }}) ;
            background-size: cover;
            background-position: center;
        }

        #mail2{
            background-image:url({{ asset('images/layanan/mail2.png') }}) ;
            background-size: cover;
            background-position: center;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, var(--primary), #3a56d4);
            color: white;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            overflow-y: auto;
            z-index: 1055;
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 0.8rem 1.5rem;
            transition: all 0.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 1.5rem;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
        }

        /* Mobile header */
        .mobile-header {
            display: none;
            background: white;
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            align-items: center;
            justify-content: space-between;
        }

        @media (max-width: 991.98px) {
            .mobile-header { display: flex; }
            .sidebar { transform: translateX(-100%); width: 220px; }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 1rem; }
            #sidebarBackdrop { display: none; position: fixed; top:0; left:0; height:100vh; width:100vw; background: rgba(0,0,0,0.4); z-index:1050; }
            #sidebarBackdrop.show { display: block; }
        }

        @media (min-width: 992px) {
            #toggleSidebar, #sidebarBackdrop { display: none !important; }
        }

        #toggleSidebar { background:none; border:none; font-size:1.5rem; color:var(--primary); cursor:pointer; }

        /* Page title */
        .page-title {
            position: relative;
            padding-bottom: 12px;
            margin-bottom: 1.8rem;
            font-weight: 700;
            color: #343a40;
        }
        .page-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 70px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }

        /* Search Box */
        .search-container { margin-bottom: 2rem; max-width: 500px; }
        .search-box { position: relative; }
        .search-box input {
            border-radius: 50px;
            padding-left: 45px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
        }
        .search-box i { position: absolute; left: 20px; top: 12px; color: #a0aec0; }

        /* No results */
        .no-results { display:none; text-align:center; padding:3rem; color:#718096; }
        .no-results i { font-size:3rem; margin-bottom:1rem; color:#cbd5e0; }

        /* Service Counter */
        .service-counter { background:white; border-radius:12px; padding:1rem; margin-bottom:1.5rem; box-shadow:0 2px 8px rgba(0,0,0,0.06); border-left:4px solid var(--primary); }
        .welcome-text { color:#4a5568; margin-bottom:0.5rem; }
        .services-count { font-weight:700; color:var(--primary); font-size:1.5rem; }

        /* Service Cards */
        #servicesContainer { display:flex; flex-wrap:wrap; }
        .service-card-wrapper { display:flex; flex:1 1 300px; padding: 0.5rem; }
        .service-card {
            background-size: cover;
            background-position: center;
            border-radius:15px;
            height:300px;
            width:100%;
            position:relative;
            overflow:hidden;
            display:flex;
            flex-direction:column;
            justify-content:flex-end;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }
        .service-card-overlay {
            position:absolute; top:0; left:0; width:100%; height:100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.6) 100%);
            z-index:1;
            transition: all 0.4s ease;
        }
        .service-card-content {
            position:relative; z-index:2; padding:1.5rem; color:white; text-align:center;
        }
        .service-card h5 { font-weight:700; margin-bottom:0.5rem; }
        .service-card p { font-size:0.9rem; margin-bottom:1rem; color:rgba(255,255,255,0.9); }
        .service-card a.btn {
            border-radius:20px; padding:0.5rem 1.5rem; color:white;
            background-color: var(--primary); text-decoration:none; transition: all 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 25px rgba(0,0,0,0.2);
        }
        .service-card:hover .service-card-overlay {
            background: linear-gradient(to bottom, rgba(67, 97, 238,0.1) 0%, rgba(67,97,238,0.8) 100%);
        }
    </style>
</head>
<body>
    <div id="sidebarBackdrop"></div>

    <!-- Mobile Header -->
    <div class="mobile-header">
        <button id="toggleSidebar"><i class="fas fa-bars"></i></button>
        <div class="d-flex align-items-center">
            <i class="fas fa-tools me-2 text-primary"></i>
            <h5 class="m-0">Teknisi Dashboard</h5>
        </div>
        <div></div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="d-flex flex-column p-3">
                    <div class="d-flex align-items-center mb-4 mt-2">
                        <i class="fas fa-tools fa-2x me-2"></i>
                        <h4 class="m-0">Teknisi</h4>
                    </div>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="{{route('teknisi.index')}}" class="nav-link">
                                <i class="fa-solid fa-house-user"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a href="{{route('teknisi.layanan')}}" class="nav-link active">
                                <i class="fas fa-list"></i> <span>Layanan</span>
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

            <div class="main-content">
                <h2 class="page-title">Layanan Teknisi</h2>

                <!-- Service Counter -->
                <div class="service-counter">
                    <p class="welcome-text">Hai, Selamat datang! Anda memiliki akses ke</p>
                    <div class="services-count"><span id="serviceCount">3</span> Layanan Tersedia</div>
                </div>

                <!-- Search Box -->
                <div class="search-container">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari layanan...">
                    </div>
                </div>

                <!-- No Results Message -->
                <div class="no-results" id="noResults">
                    <i class="fas fa-search"></i>
                    <h4>Layanan tidak ditemukan</h4>
                    <p>Coba gunakan kata kunci lain</p>
                </div>

                <!-- Card Section -->
                <div class="d-flex flex-wrap col-10" id="servicesContainer">
                    <div class="service-card-wrapper">
                        <div class="service-card" id="cacti">
                            <div class="service-card-overlay"></div>
                            <div class="service-card-content">
                                <h5>Monitoring Cacti</h5>
                                <p>Pantau status sistem dan jaringan dengan Cacti</p>
                                <a href="https://monitoring.acehprov.go.id/" target="_blank" class="btn btn-primary">Kunjungi</a>
                            </div>
                        </div>
                    </div>
                    <div class="service-card-wrapper" >
                        <div class="service-card" id="mail" >
                            <div class="service-card-overlay"></div>
                            <div class="service-card-content">
                                <h5>Email Aceh Prov</h5>
                                <p>Akses layanan email resmi dengan antarmuka yang user-friendly.</p>
                                <a href="https://mailprov.acehprov.go.id/" target="_blank" class="btn btn-primary">Kunjungi</a>
                            </div>
                        </div>
                    </div>
                    <div class="service-card-wrapper" >
                        <div class="service-card" id="mail2" >
                            <div class="service-card-overlay"></div>
                            <div class="service-card-content">
                                <h5>Email AcehProv 2</h5>
                                <p>Kelola email dengan platform kolaborasi Zimbra yang lengkap.</p>
                                <a href="https://mail2.acehprov.go.id/" target="_blank" class="btn btn-primary">Kunjungi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("toggleSidebar");
    const sidebar = document.querySelector(".sidebar");
    const backdrop = document.getElementById("sidebarBackdrop");
    const searchInput = document.getElementById("searchInput");
    const servicesContainer = document.getElementById("servicesContainer");
    const serviceCards = document.querySelectorAll(".service-card");
    const noResults = document.getElementById("noResults");
    const serviceCount = document.getElementById("serviceCount");

    // Initialize service count
    serviceCount.textContent = serviceCards.length;

    function closeSidebar() { sidebar.classList.remove("show"); backdrop.classList.remove("show"); }
    function openSidebar() { sidebar.classList.add("show"); backdrop.classList.add("show"); }

    toggleBtn.addEventListener("click", function () {
        const isOpen = sidebar.classList.contains("show");
        isOpen ? closeSidebar() : openSidebar();
    });

    backdrop.addEventListener("click", closeSidebar);

    // Search functionality
    searchInput.addEventListener("input", function() {
        const searchTerm = this.value.toLowerCase();
        let visibleCount = 0;

        serviceCards.forEach(card => {
            const title = card.querySelector("h5").textContent.toLowerCase();
            const description = card.querySelector("p").textContent.toLowerCase();
            if(title.includes(searchTerm) || description.includes(searchTerm)){
                card.parentElement.style.display = "flex";
                visibleCount++;
            } else {
                card.parentElement.style.display = "none";
            }
        });

        noResults.style.display = (visibleCount === 0 && searchTerm !== "") ? "block" : "none";
        servicesContainer.style.display = (visibleCount === 0) ? "none" : "flex";
        serviceCount.textContent = visibleCount;
    });

    window.addEventListener("resize", function () {
        if(window.innerWidth >= 992) closeSidebar();
    });
});
</script>
</body>
</html>
