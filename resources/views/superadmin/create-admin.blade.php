@extends('layouts.superadmin')

@section('title', 'Tambah Admin Baru - Super Admin')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h2 style="color: #1e293b; font-size: 1.5rem;">Tambah Admin Baru</h2>
            <p style="color: #64748b; margin-top: 5px;">Masukkan detail informasi untuk akun tim administrator yang baru.</p>
        </div>
        <a href="{{ route('superadmin.admin.index') }}" style="background: #64748b; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="super-panel" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); max-width: 800px;">
        
        <form action="{{ route('superadmin.admin.store') }}" method="POST">
            @csrf <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none;">
                @error('name') <span style="color: #ef4444; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Contoh: budi@sumberunggas.com" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none;">
                @error('email') <span style="color: #ef4444; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Password</label>
                <input type="password" name="password" placeholder="Minimal 6 karakter" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none;">
                @error('password') <span style="color: #ef4444; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Hak Akses (Role)</label>
                <select name="role" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; background: white;">
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin Biasa (Hanya kelola katalog)</option>
                    <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin (Akses penuh)</option>
                </select>
                @error('role') <span style="color: #ef4444; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569;">Status Akun</label>
                <select name="status" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; background: white;">
                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status') <span style="color: #ef4444; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
            </div>

            <button type="submit" style="background: #0f766e; color: white; border: none; padding: 14px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%; font-size: 16px; display: flex; justify-content: center; align-items: center; gap: 10px;">
                <i class="fas fa-save"></i> Simpan & Tambahkan Admin
            </button>
        </form>
    </div>
@endsection