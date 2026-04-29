@extends('layouts.superadmin')

@section('title', 'Dashboard - Super Admin')

@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon icon-users"><i class="fas fa-user-shield"></i></div>
            <div class="stat-details">
                <p>Total Admin Aktif</p>
                <h3>{{ $totalAdmin }} Orang</h3>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon icon-box"><i class="fas fa-box-open"></i></div>
            <div class="stat-details">
                <p>Total Produk Katalog</p>
                <h3>{{ $totalProduk }} Item</h3>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon icon-alert"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="stat-details">
                <p>Stok Menipis</p>
                <h3>{{ $stokMenipis }} Item</h3>
            </div>
        </div>
    </div>

    <div class="super-panel">
        <h3>Aktivitas Sistem Terbaru</h3>
        <p style="color: #64748b;">Semua sistem berjalan dengan baik. Tidak ada peringatan keamanan hari ini.</p>
    </div>
@endsection