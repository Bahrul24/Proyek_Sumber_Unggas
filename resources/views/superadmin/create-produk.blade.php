@extends('layouts.superadmin')

@section('title', 'Tambah Produk - Super Admin')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h2 style="color: #1e293b; font-size: 1.5rem;">Tambah Produk Baru</h2>
        </div>
        <a href="{{ route('superadmin.katalog') }}" style="background: #64748b; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: 500;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="super-panel" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); max-width: 800px;">
        <form action="{{ route('superadmin.katalog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Nama Produk</label>
                <input type="text" name="nama_produk" placeholder="Contoh: Pakan Starter BR1" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Kategori</label>
                <select name="kategori" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; background: white;">
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    <option value="Pakan">Pakan</option>
                    <option value="Vaksin">Vaksin</option>
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Harga (Rp)</label>
                <input type="number" name="harga" placeholder="Contoh: 385000" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Satuan</label>
                <input type="text" name="satuan" placeholder="Contoh: / karung 50kg" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Stok Tersedia</label>
                <input type="number" name="stok" placeholder="Contoh: 120" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Upload Gambar Produk</label>
                <input type="file" name="gambar" accept="image/*" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; background: #f8fafc;">
            </div>

            <button type="submit" style="background: #0f766e; color: white; border: none; padding: 14px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%;">
                <i class="fas fa-save"></i> Simpan Produk
            </button>
        </form>
    </div>
@endsection