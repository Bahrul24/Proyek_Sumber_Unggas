@extends('layouts.admin')

@section('title', 'Tambah Produk Baru - Panel Admin')

@push('styles')
<style>
    .form-container { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: #334155; }
    .form-control { width: 100%; padding: 10px 15px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit; font-size: 14px; transition: border-color 0.3s; }
    .form-control:focus { outline: none; border-color: #0f766e; box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .btn-back { background-color: #64748b; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: 500; transition: 0.3s; display: inline-flex; align-items: center; gap: 8px; }
    .btn-back:hover { background-color: #475569; }
    .btn-submit { background-color: #0f766e; color: white; padding: 12px 24px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%; font-size: 16px; margin-top: 10px; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px; }
    .btn-submit:hover { background-color: #0d9488; }
</style>
@endpush

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div class="page-title">
        <h2 style="font-size: 1.5rem; color: #1e293b; margin: 0;">Tambah Produk Baru</h2>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="form-container">
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required placeholder="Contoh: Pakan Starter BR1">
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Pakan">Pakan Ternak</option>
                <option value="Vaksin">Vaksin Ayam</option>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" required placeholder="Contoh: 385000">
            </div>
            <div class="form-group">
                <label>Stok Tersedia</label>
                <input type="number" name="stok" class="form-control" required placeholder="Contoh: 120">
            </div>
        </div>

        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" class="form-control" required placeholder="Contoh: / karung 50kg">
        </div>

        <div class="form-group">
            <label>Upload Gambar Produk</label>
            <input type="file" name="gambar" accept="image/*" class="form-control" style="padding: 7px 15px; background: #f8fafc;">
        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i> Simpan Produk
        </button>
    </form>
</div>
@endsection