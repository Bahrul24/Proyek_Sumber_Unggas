@extends('layouts.app')

@section('title', 'Katalog - Sumber Unggas')

@section('content')

    <section class="catalog-page pb-80" style="padding-top: 40px;">
        <div class="container">
            
            <div class="section-title text-center">
                <h2>Katalog Produk</h2>
                <p>Pilihan lengkap pakan ternak dan vaksin ayam petelur berkualitas tinggi</p>
            </div>

            <div class="catalog-filter">
                <button class="filter-btn active" data-filter="semua">Semua</button>
                <button class="filter-btn" data-filter="pakan">Pakan Ternak</button>
                <button class="filter-btn" data-filter="vaksin">Vaksin Ayam</button>
            </div>

            <div class="catalog-grid" id="productGrid">
                
                @forelse($products as $product)
                    <div class="product-card" data-kategori="{{ strtolower($product->kategori) }}">
                        
                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}" style="width: 100%; height: 250px; object-fit: cover;">
                        
                        <div class="product-info">
                            <h4>{{ $product->nama_produk }}</h4>
                            <p>Kategori: {{ ucfirst($product->kategori) }}</p>
                            <div class="divider"></div>
                            <div class="product-footer">
                                <div class="price">
                                    <strong>Rp {{ number_format($product->harga, 0, ',', '.') }}</strong>
                                    <span>{{ $product->satuan }}</span>
                                </div>
                                
                                @if($product->stok > 0)
                                    <span class="stock-badge">Stok: {{ $product->stok }}</span>
                                @else
                                    <span class="stock-badge" style="background-color: #fef2f2; color: #ef4444; border-color: #fecaca;">Stok: Habis</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 50px; color: #64748b;">
                        <i class="fas fa-box-open" style="font-size: 48px; margin-bottom: 15px; color: #cbd5e1;"></i>
                        <p>Belum ada produk di katalog.</p>
                    </div>
                @endforelse

            </div>

            <div class="pagination">
                <a href="#" class="page-link prev">&laquo; Prev</a>
                <a href="#" class="page-link active">1</a>
                <a href="#" class="page-link">2</a>
                <a href="#" class="page-link">3</a>
                <span class="page-dots">...</span>
                <a href="#" class="page-link next">Next &raquo;</a>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const productCards = document.querySelectorAll('.product-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // 1. Hapus warna hijau dari semua tombol
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // 2. Tambahkan warna hijau ke tombol yang diklik
                button.classList.add('active');

                // 3. Ambil data filter tombol ('semua', 'pakan', atau 'vaksin')
                const filterValue = button.getAttribute('data-filter');

                // 4. Bandingkan dengan kartu produk
                productCards.forEach(card => {
                    const productCategory = card.getAttribute('data-kategori');
                    
                    if (filterValue === 'semua' || filterValue === productCategory) {
                        card.classList.remove('hidden'); 
                        card.style.display = 'block'; 
                    } else {
                        card.classList.add('hidden'); 
                        card.style.display = 'none'; 
                    }
                });
            });
        });
    });
</script>
@endpush