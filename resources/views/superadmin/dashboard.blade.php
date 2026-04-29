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

    <div class="super-panel" style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin-top: 25px;">
        <h3 style="margin-bottom: 15px; color: #1e293b;">Aktivitas Sistem Terbaru</h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0; color: #64748b;">
                        <th style="padding: 12px 10px;">Waktu</th>
                        <th style="padding: 12px 10px;">User</th>
                        <th style="padding: 12px 10px;">Aktivitas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aktivitasTerbaru as $log)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px 10px; color: #94a3b8;">{{ $log->created_at->format('d M Y, H:i') }}</td>
                            <td style="padding: 12px 10px; font-weight: 500;">{{ $log->user->name ?? 'Sistem' }}</td>
                            <td style="padding: 12px 10px;">{{ $log->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="super-panel" style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin-top: 25px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div>
                <h3 style="color: #1e293b; margin: 0;">Kelola Produk Unggulan</h3>
                <p style="color: #64748b; font-size: 0.85rem; margin-top: 5px;">Tampil di Beranda Pelanggan.</p>
            </div>
            <button onclick="openModal()" style="background: #0f766e; color: white; border: none; padding: 10px 15px; border-radius: 6px; cursor: pointer; font-weight: bold;">
                <i class="fas fa-plus"></i> Tambah Unggulan
            </button>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
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
                                <img src="{{ asset('storage/' . $produk->gambar) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px;">
                            </td>
                            <td style="padding: 12px 10px; font-weight: 500;">{{ $produk->nama_produk }}</td>
                            <td style="padding: 12px 10px; color: #0f766e; font-weight: bold;">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td style="padding: 12px 10px; text-align: center;">
                                <button onclick="confirmDelete({{ $produk->id }})" style="background: #ef4444; color: white; border: none; padding: 8px; border-radius: 4px; cursor: pointer;">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $produk->id }}" action="{{ route('superadmin.unggulan.destroy', $produk->id) }}" method="POST" style="display:none;">
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

    <div id="modalUnggulan" style="display:none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);">
        <div style="background: white; width: 400px; margin: 10% auto; padding: 25px; border-radius: 12px;">
            <h3>Pilih Produk</h3>
            <form action="{{ route('superadmin.unggulan.store') }}" method="POST">
                @csrf
                <select name="product_id" required style="width: 100%; padding: 10px; margin: 15px 0; border: 1px solid #e2e8f0; border-radius: 6px;">
                    <option value="">-- Pilih --</option>
                    @foreach($pilihanProduk as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
                    @endforeach
                </select>
                <div style="display: flex; gap: 10px;">
                    <button type="submit" style="flex: 1; background: #0f766e; color: white; border: none; padding: 10px; border-radius: 6px; cursor: pointer;">Simpan</button>
                    <button type="button" onclick="closeModal()" style="flex: 1; background: #64748b; color: white; border: none; padding: 10px; border-radius: 6px; cursor: pointer;">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openModal() { document.getElementById('modalUnggulan').style.display = 'block'; }
        function closeModal() { document.getElementById('modalUnggulan').style.display = 'none'; }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Lepas Unggulan?',
                text: "Produk ini tidak akan muncul lagi di beranda depan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Lepas!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) { document.getElementById('delete-form-' + id).submit(); }
            })
        }

        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil', text: "{{ session('success') }}", timer: 2000, showConfirmButton: false });
        @endif
    </script>
@endsection