<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Sumber Unggas')</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
</head>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Sumber Unggas')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
</head>

<body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;">

    <header class="admin-header" style="display: flex; justify-content: space-between; align-items: center; padding: 15px 20px;">
        <h2><i class="fas fa-cogs"></i> Panel Admin</h2>
        
        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="{{ url('/') }}" class="btn-back"><i class="fas fa-external-link-alt"></i> Lihat Website</a>
            
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-back" style="background-color: #dc2626; color: white; border: none; cursor: pointer; padding: 10px 15px; border-radius: 4px; font-family: inherit; font-size: inherit;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </header>

    <main style="flex: 1;">
        @yield('content')
    </main>

    <footer style="text-align: center; padding: 20px; color: #6b7280; font-size: 0.875rem; border-top: 1px solid #e5e7eb; background: #fff; margin-top: 20px;">
        &copy; {{ date('Y') }} Sumber Unggas. All rights reserved.
    </footer>

</body>
</html>