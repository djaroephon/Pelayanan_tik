<footer class="relative overflow-hidden bg-surface-950 pt-24 pb-12 text-white">
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 h-px w-full bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
    <div class="absolute -top-24 -left-24 h-48 w-48 rounded-full bg-primary-600/10 blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 h-48 w-48 rounded-full bg-accent-600/10 blur-3xl"></div>

    <div class="container relative z-10 mx-auto px-6">
        <div class="grid grid-cols-1 gap-16 lg:grid-cols-12">
            <!-- Brand Column -->
            <div class="lg:col-span-5">
                <div class="mb-8 flex items-center space-x-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white shadow-xl shadow-white/5 p-2.5">
                        <img src="{{ asset('images/logo-pancacita.png') }}" alt="Logo" class="h-full w-auto">
                    </div>
                    <div>
                        <h3 class="font-display text-2xl font-bold tracking-tight">Diskominsa Aceh</h3>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-primary-400">Bidang Layanan TIK</p>
                    </div>
                </div>
                <p class="max-w-md text-lg leading-relaxed text-surface-400">
                    Mewujudkan transformasi digital yang inklusif dan berkelanjutan bagi seluruh instansi di lingkungan Pemerintah Aceh.
                </p>
                <div class="mt-10 flex space-x-4">
                    <a href="#" class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/5 transition-all hover:bg-primary-600 hover:scale-110">
                        <i data-lucide="facebook" class="h-5 w-5"></i>
                    </a>
                    <a href="#" class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/5 transition-all hover:bg-primary-600 hover:scale-110">
                        <i data-lucide="instagram" class="h-5 w-5"></i>
                    </a>
                    <a href="#" class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/5 transition-all hover:bg-primary-600 hover:scale-110">
                        <i data-lucide="twitter" class="h-5 w-5"></i>
                    </a>
                </div>
            </div>
            
            <!-- Links Column -->
            <div class="lg:col-span-3">
                <h4 class="font-display mb-8 text-sm font-bold uppercase tracking-[0.2em] text-white">Tautan Cepat</h4>
                <ul class="space-y-4">
                    <li>
                        <a href="#home" class="group flex items-center space-x-2 text-surface-400 transition-all hover:text-white">
                            <span class="h-1 w-0 bg-primary-500 transition-all group-hover:w-4"></span>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="#about" class="group flex items-center space-x-2 text-surface-400 transition-all hover:text-white">
                            <span class="h-1 w-0 bg-primary-500 transition-all group-hover:w-4"></span>
                            <span>Tentang Kami</span>
                        </a>
                    </li>
                    <li>
                        <a href="#services" class="group flex items-center space-x-2 text-surface-400 transition-all hover:text-white">
                            <span class="h-1 w-0 bg-primary-500 transition-all group-hover:w-4"></span>
                            <span>Layanan TIK</span>
                        </a>
                    </li>
                    <li>
                        <a href="#contact" class="group flex items-center space-x-2 text-surface-400 transition-all hover:text-white">
                            <span class="h-1 w-0 bg-primary-500 transition-all group-hover:w-4"></span>
                            <span>Hubungi Kami</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Contact Column -->
            <div class="lg:col-span-4">
                <h4 class="font-display mb-8 text-sm font-bold uppercase tracking-[0.2em] text-white">Hubungi Kami</h4>
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary-500/10 text-primary-400">
                            <i data-lucide="map-pin" class="h-5 w-5"></i>
                        </div>
                        <p class="text-surface-400">
                            Gedung Sentral Telematika,<br>
                            Banda Aceh, Aceh - Indonesia
                        </p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary-500/10 text-primary-400">
                            <i data-lucide="mail" class="h-5 w-5"></i>
                        </div>
                        <a href="mailto:support@tik.acehprov.go.id" class="text-surface-400 transition-colors hover:text-white">support@tik.acehprov.go.id</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary-500/10 text-primary-400">
                            <i data-lucide="clock" class="h-5 w-5"></i>
                        </div>
                        <p class="text-surface-400">Senin - Jumat: 08:00 - 16:30 WIB</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Section -->
        <div class="mt-24 border-t border-white/5 pt-12">
            <div class="flex flex-col items-center justify-between space-y-6 md:flex-row md:space-y-0">
                <p class="text-sm text-surface-500">
                    &copy; {{ date('Y') }} Dinas Komunikasi, Informatika dan Persandian Aceh.
                </p>
                <div class="flex space-x-8 text-sm text-surface-500">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>
