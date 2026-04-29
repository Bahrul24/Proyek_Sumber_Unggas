@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

    <div class="admin-container">
        
        <div class="admin-card">
            <h3 class="card-title">Tambah Produk Baru</h3>
            
            @if(session('success'))
                <div style="padding: 10px; background: #dcfce7; color: #166534; margin-bottom: 15px; border-radius: 8px;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" required placeholder="Contoh: Pakan Starter BR1">
                </div>
                
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control" required>
                        <option value="Pakan">Pakan Ternak</option>
                        <option value="Vaksin">Vaksin Ayam</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" required placeholder="Contoh: 385000">
                </div>

                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" name="satuan" class="form-control" required placeholder="Contoh: / karung 50kg">
                </div>

                <div class="form-group">
                    <label>Stok Tersedia</label>
                    <input type="number" name="stok" class="form-control" required placeholder="Contoh: 120">
                </div>

                <div class="form-group">
                    <label>Upload Gambar Produk</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*" required style="padding: 9px 15px;">
                </div>

                <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Simpan Produk</button>
            </form>
        </div> 
        
        <div class="admin-card">
            <h3 class="card-title">Daftar Produk Katalog</h3>
            
            <div style="margin-bottom: 20px; display: flex; gap: 10px;">
                <a href="{{ route('admin.dashboard') }}" 
                   style="padding: 8px 15px; border-radius: 20px; text-decoration: none; font-weight: bold; 
                          background: {{ request('kategori') == null ? '#0f766e' : '#e2e8f0' }}; 
                          color: {{ request('kategori') == null ? 'white' : '#475569' }};">
                    Semua
                </a>
                <a href="{{ route('admin.dashboard', ['kategori' => 'Pakan']) }}" 
                   style="padding: 8px 15px; border-radius: 20px; text-decoration: none; font-weight: bold; 
                          background: {{ strtolower(request('kategori')) == 'pakan' ? '#0f766e' : '#e2e8f0' }}; 
                          color: {{ strtolower(request('kategori')) == 'pakan' ? 'white' : '#475569' }};">
                    Pakan Ternak
                </a>
                <a href="{{ route('admin.dashboard', ['kategori' => 'Vaksin']) }}" 
                   style="padding: 8px 15px; border-radius: 20px; text-decoration: none; font-weight: bold; 
                          background: {{ strtolower(request('kategori')) == 'vaksin' ? '#0f766e' : '#e2e8f0' }}; 
                          color: {{ strtolower(request('kategori')) == 'vaksin' ? 'white' : '#475569' }};">
                    Vaksin Ayam
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $item)
                            <tr>
                                <td><img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;"></td>
                                <td><strong>{{ $item->nama_produk }}</strong></td>
                                <td>
                                    @if(strtolower($item->kategori) == 'pakan')
                                        <span class="badge-kategori">Pakan</span>
                                    @else
                                        <span class="badge-kategori" style="background: #fce7f3; color: #be185d;">Vaksin</span>
                                    @endif
                                </td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>
                                    <div class="action-btns" style="display: flex; gap: 8px; align-items: center;">
                                        <a href="{{ route('product.edit', $item->id) }}" class="btn-edit" title="Edit" style="display: inline-flex; justify-content: center; align-items: center; width: 36px; height: 36px; text-decoration: none; padding: 0;">
                                            <i class="fas fa-edit"></i>
                                        </a>
    
                                    <form action="{{ route('product.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk {{ $item->nama_produk }} ini?');" style="margin: 0; padding: 0; display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Hapus" style="display: inline-flex; justify-content: center; align-items: center; width: 36px; height: 36px; border: none; cursor: pointer; padding: 0;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #64748b; padding: 20px;">
                                    Belum ada data produk untuk kategori ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection