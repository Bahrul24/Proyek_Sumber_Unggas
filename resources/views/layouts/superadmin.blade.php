<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Super Admin - Sumber Unggas')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/super-admin.css') }}">
</head>
<body>

    <div class="super-admin-layout">
        
        <aside class="sidebar">
            <div class="sidebar-logo">
                <img src="{{ asset('images/logo-su.png') }}" alt="Logo Sumber Unggas" onerror="this.src='https://via.placeholder.com/70?text=SU'">
                <h2>Super Admin</h2>
            </div>
            
            <ul class="sidebar-menu">
                <li><a href="/superadmin" class="{{ request()->is('superadmin') ? 'active' : '' }}"><i class="fas fa-home"></i> Ringkasan Utama</a></li>
                <li><a href="/superadmin/admin" class="{{ request()->is('superadmin/admin*') ? 'active' : '' }}"><i class="fas fa-users-cog"></i> Kelola Tim Admin</a></li>
                <li><a href="/superadmin/katalog" class="{{ request()->is('superadmin/katalog*') ? 'active' : '' }}"><i class="fas fa-boxes"></i> Kontrol Katalog</a></li>
                <li><a href="/superadmin/laporan" class="{{ request()->is('superadmin/laporan*') ? 'active' : '' }}"><i class="fas fa-chart-bar"></i> Laporan Aktivitas</a></li>
                <li><a href="/superadmin/pengaturan" class="{{ request()->is('superadmin/pengaturan*') ? 'active' : '' }}"><i class="fas fa-cogs"></i> Pengaturan Sistem</a></li>
            </ul>
        </aside>

        <main class="main-wrapper">
            
            <header class="topbar">
                <div class="topbar-left">
                    <h3><i class="fas fa-shield-alt" style="color: #0f766e; margin-right: 8px;"></i> Panel Kendali Pusat</h3>
                </div>
                <div class="topbar-right">
                    <span style="font-weight: 500; color: #475569;">Halo, {{ Auth::user()->name }}!</span>
                    
                    <a href="#" class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </header>

            <div class="content">
                @yield('content')
            </div>

        </main>

    </div>

</body>
</html>