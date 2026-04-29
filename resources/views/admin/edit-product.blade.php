@extends('layouts.admin')

@section('title', 'Edit Produk - Sumber Unggas')

@section('content')

    <div class="admin-container" style="display: flex; justify-content: center; padding-top: 30px;">
        
        <div class="admin-card" style="width: 100%; max-width: 600px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 class="card-title" style="margin: 0;">Edit Produk</h3>
                <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #64748b;"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
            
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" value="{{ $product->nama_produk }}" required>
                </div>
                
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control" required>
                        <option value="pakan" {{ $product->kategori == 'pakan' ? 'selected' : '' }}>Pakan Ternak</option>
                        <option value="vaksin" {{ $product->kategori == 'vaksin' ? 'selected' : '' }}>Vaksin Ayam</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" value="{{ $product->harga }}" required>
                </div>

                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" name="satuan" class="form-control" value="{{ $product->satuan }}" required>
                </div>

                <div class="form-group">
                    <label>Stok Tersedia</label>
                    <input type="number" name="stok" class="form-control" value="{{ $product->stok }}" required>
                </div>

                <div class="form-group">
                    <label>Gambar Produk Saat Ini</label><br>
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="Gambar Produk" style="width: 100px; border-radius: 8px; margin-bottom: 10px;">
                    
                    <label>Ganti Gambar (Kosongkan jika tidak ingin mengganti)</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*" style="padding: 9px 15px;">
                </div>

                <button type="submit" class="btn-submit" style="width: 100%;"><i class="fas fa-save"></i> Update Produk</button>
            </form>
        </div> 

    </div>

@endsection