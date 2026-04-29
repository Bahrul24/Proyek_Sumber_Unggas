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
                {{-- Loop Data Produk dari Database --}}
                @forelse($produkUnggulan as $produk)
                    <div class="product-card">
                        {{-- Menampilkan gambar produk, pastikan sudah di-upload ke folder storage --}}
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                        
                        <div class="product-info">
                            <h4>{{ $produk->nama_produk }}</h4>
                            <p>{{ Str::limit($produk->deskripsi, 80) }}</p>
                            
                            <div class="product-footer">
                                <div class="price">
                                    <strong>Rp {{ number_format($produk->harga, 0, ',', '.') }}</strong>
                                    <span>/ {{ $produk->satuan }}</span>
                                </div>
                                <span class="stock">Stok: {{ $produk->stok }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Pesan jika is_unggulan bernilai 1 tidak ditemukan di database --}}
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: #f8fafc; border-radius: 12px;">
                        <p style="color: #64748b; font-style: italic;">Saat ini belum ada produk unggulan yang tersedia.</p>
                    </div>
                @endforelse
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