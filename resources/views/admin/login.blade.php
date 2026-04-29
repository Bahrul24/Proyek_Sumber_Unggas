<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal - Sumber Unggas</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
</head>
<body class="login-page"> <div class="login-card fade-in">
        <div class="logo-section" style="margin-bottom: 30px; border-bottom: none;">
            <div class="logo-text">
                <h1 style="font-size: 1.8rem; color: #1f2937;">Sumber Unggas</h1>
                <span style="font-size: 0.875rem; color: #6b7280;">Panel Admin</span>
            </div>
        </div>

        <p class="login-subtitle">Silakan login untuk mengakses panel admin.</p>

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope"></i> <input type="email" name="email" id="email" class="form-control" required autofocus placeholder="Masukkan email">
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i> <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan password">
                </div>
            </div>

            <button type="submit" class="btn-login-green">Masuk ke Sistem <i class="fas fa-sign-in-alt" style="margin-left: 10px;"></i></button>
        </form>
    </div>

</body>
</html>