<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title', 'Sumber Unggas')</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-white">

    <header>
        <div class="logo-section">
            <img src="{{ asset('images/logo-su.png') }}" alt="Logo Sumber Unggas" style="width: 50px; height: 50px; object-fit: contain; background-color: white; border-radius: 50%; padding: 5px;">
            <div class="logo-text">
                <h1>Sumber Unggas</h1>
                <span>Poultry Shop</span>
            </div>
        </div>
        
        <div class="menu-toggle" id="mobile-menu">
            <i class="fas fa-bars"></i>
        </div>

        <nav id="nav-menu">
            <ul>
                <li>
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                </li>
                <li>
                    <a href="{{ url('/profil-toko') }}" class="{{ request()->is('profil-toko') ? 'active' : '' }}">Profil Toko</a>
                </li>
                <li>
                    <a href="{{ url('/tentang-kami') }}" class="{{ request()->is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a>
                </li>
                <li>
                    <a href="{{ url('/katalog') }}" class="{{ request()->is('katalog') ? 'active' : '' }}">Katalog</a>
                </li>
                <li>
                    <a href="{{ url('/kontak') }}" class="{{ request()->is('kontak') ? 'active' : '' }}">Kontak</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer id="kontak">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>Sumber Unggas</h4>
                    <p>Toko pakan ternak dan vaksin ayam petelur terpercaya sejak 2010. Melayani peternak di seluruh Indonesia dengan produk berkualitas.</p>
                </div>
                
                <div class="footer-col">
                    <h4>Kontak</h4>
                    
                    @php
                        // Ganti tulisan 'nomor_telepon', 'email', dan 'alamat' di bawah ini 
                        // jika nama key di database/controller Anda berbeda.
                        $telepon = \App\Models\Setting::where('key', 'no_telp')->value('value') ?? '+62 812-3456-7890';
                        $email   = \App\Models\Setting::where('key', 'email_kontak  ')->value('value') ?? 'info@sumberunggas.com';
                        $alamat  = \App\Models\Setting::where('key', 'alamat')->value('value') ?? 'Jl. Peternakan Raya No. 123, Jakarta';
                    @endphp

                    <ul class="contact-info">
                        <li><i class="fas fa-phone-alt"></i> {{ $telepon }}</li>
                        <li><i class="far fa-envelope"></i> {{ $email }}</li>
                        <li><i class="fas fa-map-marker-alt"></i> {{ $alamat }}</li>
                    </ul>
                    </div>

                <div class="footer-col">
                    <h4>Ikuti Kami</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Sumber Unggas. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // 1. Menu Mobile
        document.getElementById('mobile-menu').addEventListener('click', () => {
            document.getElementById('nav-menu').classList.toggle('active');
        });

        // 2. Fade In Animasi
        const appearOnScroll = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: "0px 0px -50px 0px" });
        
        document.querySelectorAll('.fade-in').forEach(fader => appearOnScroll.observe(fader));

        // 3. Smart Header
        let lastScrollTop = 0;
        const header = document.querySelector('header');
        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > 10) {
                if (scrollTop > lastScrollTop) header.style.top = "-100px";
                else header.style.top = "0";
            } else header.style.top = "0";
            lastScrollTop = scrollTop;
        });
    </script>

    @stack('scripts')

</body>
</html>