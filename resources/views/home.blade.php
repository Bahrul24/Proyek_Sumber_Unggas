@extends('layouts.app')

@section('title', 'Beranda - Sumber Unggas')

@section('content')

    <section class="hero fade-in">
        <div class="hero-content">
            <h2>Pakan Ternak & Vaksin Berkualitas</h2>
            <h3>Untuk Hasil Panen Maksimal</h3>
            <p>Kami menyediakan berbagai kebutuhan peternakan ayam petelur dan pedaging dengan kualitas terjamin dan harga terbaik.</p>
            <a href="{{ url('/katalog') }}" class="btn-katalog">Lihat Katalog <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <section class="features-section mb-80 fade-in">
        <div class="container">
            <div class="features-wrapper">
                
                <div class="feature-card">
                    <div class="feature-icon">📦</div>
                    <h3 class="feature-title">Produk Lengkap</h3>
                    <p class="feature-desc">Tersedia berbagai jenis pakan dan obat-obatan unggas berkualitas untuk segala kebutuhan peternakan Anda.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🏅</div>
                    <h3 class="feature-title">Kualitas Terjamin</h3>
                    <p class="feature-desc">Produk asli dari merk terpercaya dan tersertifikasi untuk memastikan kesehatan & produktivitas unggas.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">🚚</div>
                    <h3 class="feature-title">Pengiriman Cepat</h3>
                    <p class="feature-desc">Layanan pesan antar langsung ke lokasi peternakan Anda dengan armada yang aman dan tepat waktu.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="products fade-in" id="katalog">
        <div class="container">
            <div class="section-title">
                <h2>Produk Unggulan Kami</h2>
                <p>Pilihan terbaik untuk peternakan Anda</p>
            </div>
            
            <div class="catalog-grid"> 
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1599839619722-39751411ea63?q=80&w=600&auto=format&fit=crop" alt="Pakan Ayam">
                    <div class="product-info">
                        <h4>Pakan Petelur Premium</h4>
                        <p>Pakan komplit butiran untuk ayam petelur dewasa. Meningkatkan produksi telur.</p>
                        <div class="product-footer">
                            <div class="price">
                                <strong>Rp 385.000</strong>
                                <span>/ karung 50kg</span>
                            </div>
                            <span class="stock">Stok: 120</span>
                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1584362917165-526a968579e8?q=80&w=600&auto=format&fit=crop" alt="Vaksin ND">
                    <div class="product-info">
                        <h4>Vaksin ND-IB Live</h4>
                        <p>Vaksin aktif untuk mencegah penyakit ND dan IB pada ayam.</p>
                        <div class="product-footer">
                            <div class="price">
                                <strong>Rp 125.000</strong>
                                <span>/ botol</span>
                            </div>
                            <span class="stock">Stok: 50</span>
                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1599839619722-39751411ea63?q=80&w=600&auto=format&fit=crop" alt="Pakan Pedaging">
                    <div class="product-info">
                        <h4>Pakan Broiler Starter</h4>
                        <p>Pakan masa awal pertumbuhan broiler. Kaya protein dan nutrisi.</p>
                        <div class="product-footer">
                            <div class="price">
                                <strong>Rp 410.000</strong>
                                <span>/ karung 50kg</span>
                            </div>
                            <span class="stock">Stok: 85</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="view-all">
                <a href="{{ url('/katalog') }}">Lihat Semua Produk <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </section>

    <section class="cta-section bg-green mb-80 fade-in text-center">
        <div class="container">
            <h2>Siap Meningkatkan Produktivitas Peternakan Anda?</h2>
            <p>Hubungi kami sekarang untuk konsultasi dan pemesanan produk terbaik.</p>
            <a href="{{ url('/kontak') }}" class="btn-white">Hubungi Kami Sekarang</a>
        </div>
    </section>

@endsection