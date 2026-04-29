@extends('layouts.superadmin')

@section('title', 'Kontrol Katalog - Super Admin')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h2 style="color: #1e293b; font-size: 1.5rem; margin: 0;">Kontrol Katalog Global</h2>
            <p style="color: #64748b; margin: 5px 0 0 0;">Kelola semua produk pakan dan unggas yang tampil di website utama.</p>
        </div>
        <a href="{{ route('superadmin.katalog.create') }}" style="background: #0f766e; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; transition: 0.3s;">
            <i class="fas fa-plus"></i> Tambah Produk Baru
        </a>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #22c55e;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 15px; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Gambar</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Nama Produk</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Kategori</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Harga</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Stok</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produks as $produk)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: 0.2s;" onmouseover="this.style.background='#fcfcfc'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 15px;">
                            @if($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Produk" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                            @else
                                <div style="width: 50px; height: 50px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #cbd5e1;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td style="padding: 15px;">
                            <div style="font-weight: 600; color: #1e293b;">{{ $produk->nama_produk }}</div>
                            <div style="font-size: 0.75rem; color: #94a3b8;">ID: #PRD-{{ $produk->id }}</div>
                        </td>
                        <td style="padding: 15px;">
                            <span style="background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                {{ $produk->kategori }}
                            </span>
                        </td>
                        <td style="padding: 15px; color: #475569; font-weight: 500;">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            <small style="display: block; color: #94a3b8; font-size: 0.7rem;">{{ $produk->satuan }}</small>
                        </td>
                        <td style="padding: 15px;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="font-weight: 600; color: {{ $produk->stok < 10 ? '#ef4444' : '#475569' }};">
                                    {{ $produk->stok }}
                                </span>
                                @if($produk->stok < 10)
                                    <i class="fas fa-exclamation-triangle" style="color: #f59e0b; font-size: 0.8rem;" title="Stok Menipis!"></i>
                                @endif
                            </div>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <div style="display: flex; gap: 8px; justify-content: center;">
                                <a href="{{ route('superadmin.katalog.edit', $produk->id) }}" style="background: #f59e0b; color: white; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer; text-decoration: none; transition: 0.2s;" title="Edit Produk">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('superadmin.katalog.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk {{ $produk->nama_produk }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: #ef4444; color: white; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer; transition: 0.2s;" title="Hapus Produk">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 40px; text-align: center; color: #94a3b8;">
                            <i class="fas fa-box-open" style="font-size: 3rem; margin-bottom: 10px; display: block;"></i>
                            Belum ada data produk dalam katalog.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection