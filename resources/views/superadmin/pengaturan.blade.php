@extends('layouts.superadmin')

@section('content')
    <div style="margin-bottom: 25px;">
        <h2 style="color: #1e293b; font-size: 1.5rem;">Pengaturan Sistem</h2>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); max-width: 800px;">
        <form action="{{ route('superadmin.pengaturan.update') }}" method="POST">
            @csrf
            
            <div style="margin-bottom: 20px;">
                <label>Nama Website / Toko</label>
                <input type="text" name="nama_toko" value="{{ $settings['nama_toko'] ?? '' }}" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>

            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                <div style="flex: 1;">
                    <label>Email Kontak</label>
                    <input type="email" name="email_kontak" value="{{ $settings['email_kontak'] ?? '' }}" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
                <div style="flex: 1;">
                    <label>Nomor Telepon</label>
                    <input type="text" name="no_telp" value="{{ $settings['no_telp'] ?? '' }}" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label>Alamat Lengkap</label>
                <textarea name="alamat" rows="3" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px;">{{ $settings['alamat'] ?? '' }}</textarea>
            </div>


            <button type="submit" style="background: #10b981; color: white; border: none; padding: 14px 24px; border-radius: 6px; cursor: pointer; width: 100%; font-weight: bold;">
                Simpan Perubahan
            </button>
        </form>
    </div>
@endsection