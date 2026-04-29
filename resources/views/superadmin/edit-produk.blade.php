@extends('layouts.superadmin')

@section('title', 'Edit Produk - Super Admin')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h2 style="color: #1e293b; font-size: 1.5rem;">Edit Produk: {{ $produk->nama_produk }}</h2>
        <a href="{{ route('superadmin.katalog') }}" style="background: #64748b; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px;">Kembali</a>
    </div>

    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 800px;">
        <form action="{{ route('superadmin.katalog.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT') 
            
            <div style="margin-bottom: 15px;">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Kategori</label>
                <select name="kategori" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                    <option value="Pakan" {{ $produk->kategori == 'Pakan' ? 'selected' : '' }}>Pakan Ternak</option>
                    <option value="Bibit" {{ $produk->kategori == 'Bibit' ? 'selected' : '' }}>Bibit Unggas</option>
                    <option value="Obat" {{ $produk->kategori == 'Obat' ? 'selected' : '' }}>Vitamin & Obat</option>
                </select>
            </div>

            <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                <div style="flex: 1;">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga" value="{{ $produk->harga }}" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div style="flex: 1;">
                    <label>Stok</label>
                    <input type="number" name="stok" value="{{ $produk->stok }}" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Satuan</label>
                <input type="text" name="satuan" value="{{ $produk->satuan }}" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label>Gambar Produk (Kosongkan jika tidak ingin ganti)</label>
                @if($produk->gambar)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ asset('storage/' . $produk->gambar) }}" width="80" style="border-radius: 5px;">
                    </div>
                @endif
                <input type="file" name="gambar" style="width: 100%; padding: 10px; background: #f8fafc; border-radius: 6px;">
            </div>

            <button type="submit" style="background: #f59e0b; color: white; border: none; padding: 12px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%;">
                Update Produk
            </button>
        </form>
    </div>
@endsection