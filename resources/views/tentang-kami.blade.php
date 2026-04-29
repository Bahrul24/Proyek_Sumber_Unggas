@extends('layouts.app')

@section('title', 'Tentang Kami - Sumber Unggas')

@section('content')

    <section class="about-section mb-80 fade-in" style="padding-top: 120px;">
        <div class="container">
            <div class="about-wrapper">
                <div class="about-image">
                       <img src="{{ asset('images/ceo-su.jpeg') }}" alt="Profil Sumber Unggas" style="width: 100%; border-radius: 20px; box-shadow: 20px 20px 0px #e6f4ea;">
                </div>
                
                <div class="about-content">
                    <span class="badge-green">Profile Pemilik</span>
                    <h3 class="owner-name">Bapak Surya Wijaya</h3>
                    <div class="accent-line"></div>
                    
                    <p class="about-description">
                        Peternak ayam berpengalaman lebih dari <strong>20 tahun</strong>. Memulai usaha dari peternakan kecil hingga kini menjadi <em>supplier</em> pakan dan vaksin terpercaya di Jakarta. Kami berkomitmen untuk selalu memberikan kualitas produk terbaik dan konsultasi terarah demi menunjang produktivitas maksimal peternakan Anda.
                    </p>
                    
                    <div class="about-stats">
                        <div class="stat-item">
                            <h4>2010</h4>
                            <p>Tahun Berdiri</p>
                        </div>
                        <div class="stat-item">
                            <h4>20+</h4>
                            <p>Tahun Pengalaman</p>
                        </div>
                        <div class="stat-item">
                            <h4>1000+</h4>
                            <p>Pelanggan Terbantu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="store-info-section mb-80 fade-in">
        <div class="container">
            <div class="info-wrapper">
                <div class="info-image">
                    <img src="https://images.unsplash.com/photo-1589923188900-85dae523342b?q=80&w=800&auto=format&fit=crop" alt="Poultry Shop Sumber Unggas">
                </div>

                <div class="info-content">
                    <h3 class="store-name">Poultry Shop Sumber Unggas</h3>
                    <p class="store-desc">
                        Sumber Unggas adalah toko pakan ternak dan vaksin ayam petelur yang telah berdiri sejak 2010. Kami menyediakan berbagai jenis pakan berkualitas tinggi dan vaksin untuk mendukung kesuksesan peternakan ayam Anda.
                    </p>

                    <div class="contact-list">
                        <div class="contact-item">
                            <div class="icon-box">📍</div>
                            <div class="contact-text">
                                <strong>Alamat</strong>
                                <span>Jl. Peternakan Raya No. 123, Cipayung, Jakarta Timur</span>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="icon-box">📞</div>
                            <div class="contact-text">
                                <strong>Telepon</strong>
                                <span>+62 812-3456-7890</span>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="icon-box">✉️</div>
                            <div class="contact-text">
                                <strong>Email</strong>
                                <span>info@sumberunggas.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="visi-misi-section fade-in">
        <div class="container">
            <div class="visi-misi-wrapper mb-80">
                
                <div class="vm-card">
                    <div class="vm-icon">🎯</div>
                    <h3 class="vm-title">Visi</h3>
                    <p class="vm-text">
                        Menjadi distributor pakan ternak dan vaksin ayam terpercaya di Indonesia yang mendukung kesuksesan peternak dengan produk berkualitas tinggi.
                    </p>
                </div>

                <div class="vm-card">
                    <div class="vm-icon">🚀</div>
                    <h3 class="vm-title">Misi</h3>
                    <ul class="vm-list">
                        <li>
                            <span class="check-icon">✓</span> 
                            <span>Menyediakan produk berkualitas tinggi</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span> 
                            <span>Memberikan pelayanan terbaik</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span> 
                            <span>Harga kompetitif dan terjangkau</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

@endsection