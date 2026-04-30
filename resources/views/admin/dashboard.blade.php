@extends('layouts.admin')

@section('title', 'Kontrol Katalog & Unggulan - Panel Admin')

@section('content')

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 25px;">
        <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); display: flex; align-items: center; gap: 15px; border-left: 4px solid #0f766e;">
            <div style="background: #ccfbf1; color: #0f766e; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-boxes"></i>
            </div>
            <div>
                <p style="margin: 0; color: #64748b; font-size: 0.9rem; font-weight: 500;">Total Produk Katalog</p>
                <h3 style="margin: 5px 0 0; color: #1e293b; font-size: 1.5rem;">{{ $totalProduk ?? 0 }} Item</h3>
            </div>
        </div>

        <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); display: flex; align-items: center; gap: 15px; border-left: 4px solid #ef4444;">
            <div style="background: #fee2e2; color: #ef4444; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div>
                <p style="margin: 0; color: #64748b; font-size: 0.9rem; font-weight: 500;">Stok Menipis (< 10)</p>
                <h3 style="margin: 5px 0 0; color: #ef4444; font-size: 1.5rem;">{{ $stokMenipis ?? 0 }} Item</h3>
            </div>
        </div>
    </div>

    <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); margin-bottom: 25px; border: 1px solid #e2e8f0;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div>
                <h3 style="color: #1e293b; margin: 0;"><i class="fas fa-star" style="color: #eab308; margin-right: 8px;"></i> Kelola Produk Unggulan</h3>
                <p style="color: #64748b; font-size: 0.85rem; margin-top: 5px;">Produk di bawah ini akan tampil secara khusus di Beranda Pelanggan.</p>
            </div>
            <button onclick="openModal()" style="background: #eab308; color: white; border: none; padding: 10px 15px; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.3s;">
                <i class="fas fa-plus"></i> Tambah Unggulan
            </button>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                <thead>
                    <tr style="background: #fef9c3; border-bottom: 2px solid #fde047; color: #854d0e;">
                        <th style="padding: 12px 10px;">Gambar</th>
                        <th style="padding: 12px 10px;">Nama Produk</th>
                        <th style="padding: 12px 10px;">Harga</th>
                        <th style="padding: 12px 10px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produkUnggulan as $produk)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px 10px;">
                                @if($produk->gambar)
                                    <img src="{{ asset('storage/' . $produk->gambar) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px;">
                                @else
                                    <div style="width: 50px; height: 50px; background: #e2e8f0; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #94a3b8;">No Img</div>
                                @endif
                            </td>
                            <td style="padding: 12px 10px; font-weight: 500;">{{ $produk->nama_produk }}</td>
                            <td style="padding: 12px 10px; color: #0f766e; font-weight: bold;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td style="padding: 12px 10px; text-align: center;">
                                <button onclick="confirmLepasUnggulan({{ $produk->id }})" style="background: #ef4444; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer;" title="Lepas dari Unggulan">
                                    <i class="fas fa-times-circle"></i> Lepas
                                </button>
                                <form id="lepas-form-{{ $produk->id }}" action="{{ route('admin.unggulan.destroy', $produk->id) }}" method="POST" style="display:none;">
                                    @csrf @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="text-align: center; padding: 20px; color: #94a3b8;">Belum ada produk unggulan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div>
                <h3 style="color: #1e293b; margin: 0;"><i class="fas fa-list" style="color: #0f766e; margin-right: 8px;"></i> Kontrol Katalog Global</h3>
                <p style="color: #64748b; font-size: 0.85rem; margin-top: 5px;">Kelola semua produk pakan dan vaksin secara keseluruhan.</p>
            </div>
            <a href="{{ route('product.create') }}" style="background: #0f766e; color: white; text-decoration: none; padding: 10px 15px; border-radius: 6px; font-weight: bold; transition: 0.3s;">
                <i class="fas fa-plus"></i> Tambah Produk Baru
            </a>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0; color: #475569;">
                        <th style="padding: 12px 10px;">Gambar</th>
                        <th style="padding: 12px 10px;">Nama Produk</th>
                        <th style="padding: 12px 10px;">Kategori</th>
                        <th style="padding: 12px 10px;">Harga</th>
                        <th style="padding: 12px 10px;">Stok</th>
                        <th style="padding: 12px 10px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px 10px;">
                                @if($product->gambar)
                                    <img src="{{ asset('storage/' . $product->gambar) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px;">
                                @else
                                    <div style="width: 50px; height: 50px; background: #e2e8f0; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #94a3b8;">No Img</div>
                                @endif
                            </td>
                            <td style="padding: 12px 10px; font-weight: 500; color: #1e293b;">
                                {{ $product->nama_produk }}
                                @if($product->is_unggulan)
                                    <i class="fas fa-star" style="color: #eab308; font-size: 0.8rem; margin-left: 5px;" title="Produk Unggulan"></i>
                                @endif
                            </td>
                            <td style="padding: 12px 10px;">
                                <span style="background: {{ $product->kategori == 'Pakan' ? '#dcfce7' : '#dbeafe' }}; color: {{ $product->kategori == 'Pakan' ? '#166534' : '#1e40af' }}; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: bold;">
                                    {{ $product->kategori }}
                                </span>
                            </td>
                            <td style="padding: 12px 10px; color: #0f766e; font-weight: bold;">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td style="padding: 12px 10px;">
                                <span style="color: {{ $product->stok <= 10 ? '#ef4444' : '#1e293b' }}; font-weight: {{ $product->stok <= 10 ? 'bold' : 'normal' }};">
                                    {{ $product->stok }}
                                </span>
                            </td>
                            <td style="padding: 12px 10px; text-align: center;">
                                <div style="display: flex; gap: 5px; justify-content: center;">
                                    <a href="{{ route('product.edit', $product->id) }}" style="background: #3b82f6; color: white; padding: 6px 10px; border-radius: 4px; text-decoration: none;" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="confirmHapusProduk({{ $product->id }})" style="background: #ef4444; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer;" title="Hapus Permanen">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    
                                    <form id="hapus-form-{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:none;">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" style="text-align: center; padding: 30px; color: #94a3b8;">Belum ada produk di katalog.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="modalUnggulan" style="display:none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);">
        <div style="background: white; width: 400px; margin: 10% auto; padding: 25px; border-radius: 12px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 style="margin: 0; color: #1e293b;">Pilih Produk Unggulan</h3>
                <button type="button" onclick="closeModal()" style="background: none; border: none; font-size: 1.5rem; color: #94a3b8; cursor: pointer;">&times;</button>
            </div>
            
            <form action="{{ route('admin.unggulan.store') }}" method="POST">
                @csrf
                <select name="product_id" required style="width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit;">
                    <option value="">-- Pilih Produk dari Katalog --</option>
                    @foreach($pilihanProduk as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_produk }} (Stok: {{ $item->stok }})</option>
                    @endforeach
                </select>
                
                <div style="display: flex; gap: 10px;">
                    <button type="button" onclick="closeModal()" style="flex: 1; background: #e2e8f0; color: #475569; border: none; padding: 12px; border-radius: 6px; cursor: pointer; font-weight: bold;">Batal</button>
                    <button type="submit" style="flex: 1; background: #eab308; color: white; border: none; padding: 12px; border-radius: 6px; cursor: pointer; font-weight: bold;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Fungsi Modal
    function openModal() { document.getElementById('modalUnggulan').style.display = 'block'; }
    function closeModal() { document.getElementById('modalUnggulan').style.display = 'none'; }

    // Alert Lepas Unggulan
    function confirmLepasUnggulan(id) {
        Swal.fire({
            title: 'Lepas Unggulan?',
            text: "Produk ini tidak akan muncul lagi di beranda depan pelanggan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Lepas!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) { document.getElementById('lepas-form-' + id).submit(); }
        })
    }

    // Alert Hapus Produk Permanen
    function confirmHapusProduk(id) {
        Swal.fire({
            title: 'Hapus Permanen?',
            text: "Data produk ini akan dihapus permanen dari seluruh sistem!",
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) { document.getElementById('hapus-form-' + id).submit(); }
        })
    }

    // Flash Message Berhasil
    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Berhasil', text: "{{ session('success') }}", timer: 2500, showConfirmButton: false });
    @endif
</script>
@endpush