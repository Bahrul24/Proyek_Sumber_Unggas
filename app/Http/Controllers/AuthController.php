<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Memproses data login dari form
    public function prosesLogin(Request $request)
    {
        // 1. Validasi inputan form harus diisi
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek kecocokan email dan password di database (Auth::attempt)
        if (Auth::attempt($credentials)) {
            // Jika berhasil, buat sesi baru agar aman
            $request->session()->regenerate();
            
            // --- INI BAGIAN YANG DIUBAH (CEK ROLE) ---
            if (Auth::user()->role === 'super_admin') {
                // Jika dia Super Admin, arahkan ke Dashboard Super Admin
                return redirect()->intended('/superadmin');
            } else {
                // Jika dia Admin Biasa, arahkan ke Dashboard Admin Biasa
                return redirect()->intended('/admin/dashboard');
            }
            // ----------------------------------------
        }

        // 3. Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->with('error', 'Email atau Password salah!');
    }

    // Memproses proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/su-portal');
    }
}