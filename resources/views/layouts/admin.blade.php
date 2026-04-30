<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Sumber Unggas')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    
    @stack('styles')
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-header" style="text-align: center;">
            <div class="sidebar-logo">
                <img src="{{ asset('images/logo-su.png') }}" alt="Logo Sumber Unggas" onerror="this.src='https://via.placeholder.com/70?text=SU'">
                <h2>Panel Admin</h2>
            </div>
            
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
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
            @yield('content')
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>
</html>