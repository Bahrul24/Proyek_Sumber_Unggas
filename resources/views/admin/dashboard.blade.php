<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrol Katalog - Panel Admin</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <div style="width: 60px; height: 60px; background: white; border-radius: 50%; margin: 0 auto 10px; display:flex; align-items:center; justify-content:center; color:#0f766e; font-size: 24px; font-weight:bold;">
                <i class="fas fa-rooster"></i>
            </div>
            <h3>Panel Admin</h3>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="active">
                    <i class="fas fa-boxes"></i> Kontrol Katalog
                </a>
            </li>
        </ul>
    </aside>

    <main class="main-content">
        
        <header class="topbar">
            <div class="topbar-left">
                <i class="fas fa-shield-alt"></i> Panel Kendali Pusat
            </div>
            <div class="topbar-right">
                <span style="color: #475569; font-weight: 500;">Halo, {{ Auth::user()->name ?? 'Admin' }}!</span>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </header>

        <div class="content-area">
            
            @if(session('success'))
                <div style="background-color: #d1fae5; color: #065f46; padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #10b981;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <div class="page-header">
                <div class="page-title">
                    <h2>Kontrol Katalog Global</h2>
                    <p>Kelola semua produk pakan dan unggas yang tampil di website utama.</p>
                </div>
                <a href="{{ route('product.create') }}" class="btn-add" style="text-decoration: none; display: inline-block;">
                    <i class="fas fa-plus"></i> Tambah Produk Baru
                </a>
            </div>

            <div class="table-container">
                <table>
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
                        @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->gambar)
                                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="Img" style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                                @else
                                    <div style="width: 50px; height: 50px; background: #f1f5f9; border-radius: 6px; display:flex; align-items:center; justify-content:center; color:#94a3b8; font-size:12px; border: 1px solid #e2e8f0;">No Img</div>
                                @endif
                            </td>
                            <td>
                                <strong style="color: #1e293b;">{{ $product->nama_produk }}</strong><br>
                                <span style="font-size: 0.8rem; color: #94a3b8;">ID: #PRD-{{ $product->id }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $product->kategori == 'Vaksin' ? 'badge-vaksin' : 'badge-pakan' }}">
                                    {{ $product->kategori }}
                                </span>
                            </td>
                            <td style="font-weight: 500;">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td>
                                @if($product->stok <= 5)
                                    <span style="color: #ef4444; font-weight: bold;">{{ $product->stok }} <i class="fas fa-exclamation-triangle"></i></span>
                                @else
                                    {{ $product->stok }}
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #64748b;">
                                <i class="fas fa-box-open" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                                Belum ada produk di katalog.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </main>

</body>
</html>