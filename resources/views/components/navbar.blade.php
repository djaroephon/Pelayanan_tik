<style>
:root {
    --primary-color: #1c908d;
    --secondary-color: #156d6a;
    --accent-color: #ffc107;
}

.navbar {
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    padding: 0.8rem 1rem;
    position: sticky;
    top: 0;
    z-index: 1000;
    transition: all 0.4s ease;
    backdrop-filter: blur(10px);
}
.navbar.scrolled {
    padding: 0.5rem 1rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.navbar-brand {
    color: white;
    font-weight: 600;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    transition: transform 0.3s ease;
}
.navbar-brand:hover {
    transform: scale(1.05);
    color: white;
}
.navbar-brand img {
    margin-right: 10px;
    border-radius: 6px;
    transition: transform 0.3s ease;
}
.navbar-brand:hover img {
    transform: rotate(8deg) scale(1.1);
}

.nav-link {
    color: rgba(255,255,255,0.85) !important;
    font-weight: 500;
    position: relative;
    transition: all 0.3s ease;
}
.nav-link:hover {
    color: white !important;
}
.nav-link::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 2px;
    background: white;
    transition: width 0.3s ease;
}
.nav-link:hover::after {
    width: 80%;
}

.btn-report {
    background-color: var(--accent-color);
    font-weight: 600;
    color: #333;
    transition: all 0.3s ease;
}
.btn-report:hover {
    background-color: #e0a800;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}
.btn-login {
    background-color: white;
    color: var(--primary-color);
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-login:hover {
    background-color: #f5f5f5;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#home">
            <img src="{{ asset('images/logo-pancacita.png')}}" width="40" height="40" alt="Logo Diskominfo Aceh">
            Diskominsa Aceh
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mx-auto mb-3 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
            </ul>
            <div class="d-flex flex-column flex-lg-row gap-2 btn-container">
                <a href="{{ route('guest.login') }}" class="btn btn-report"><i class="fas fa-bullhorn me-2"></i>Login Layanan</a>
                <a href="{{ route('login') }}" class="btn btn-login"><i class="fas fa-sign-in-alt me-2"></i>Login</a>
            </div>
        </div>
    </div>
</nav>

<script>
window.addEventListener('scroll', function(){
    const navbar = document.querySelector('.navbar');
    if(window.scrollY > 50){
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});
</script>
