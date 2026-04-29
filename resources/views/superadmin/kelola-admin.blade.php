@extends('layouts.superadmin')

@section('title', 'Kelola Tim Admin - Super Admin')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h2 style="color: #1e293b; font-size: 1.5rem;">Kelola Tim Admin</h2>
            <p style="color: #64748b; margin-top: 5px;">Atur hak akses dan daftar anggota tim administrator Anda.</p>
        </div>
        <a href="{{ route('superadmin.admin.create') }}" style="background: #0f766e; color: white; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fas fa-plus"></i> Tambah Admin Baru
        </a>
    </div>

    <div class="super-panel">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 15px; color: #475569; font-weight: 600;">Nama Lengkap</th>
                        <th style="padding: 15px; color: #475569; font-weight: 600;">Email</th>
                        <th style="padding: 15px; color: #475569; font-weight: 600;">Role</th>
                        <th style="padding: 15px; color: #475569; font-weight: 600;">Status</th>
                        <th style="padding: 15px; color: #475569; font-weight: 600; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px; font-weight: 500; color: #1e293b;">{{ $admin->name }}</td>
                        <td style="padding: 15px; color: #64748b;">{{ $admin->email }}</td>
                        
                        <td style="padding: 15px;">
                            @if($admin->role == 'super_admin')
                                <span style="color: #b91c1c; font-weight:bold;">Super Admin</span>
                            @else
                                <span style="color: #0f766e;">Admin Biasa</span>
                            @endif
                        </td>

                        <td style="padding: 15px;">
                            @if($admin->status == 'aktif')
                                <span style="background: #dcfce7; color: #16a34a; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">Aktif</span>
                            @else
                                <span style="background: #fee2e2; color: #dc2626; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">Nonaktif</span>
                            @endif
                        </td>

                        <td style="padding: 15px; text-align: center; display: flex; gap: 8px; justify-content: center;">
                        <a href="{{ route('superadmin.admin.edit', $admin->id) }}" style="background: #f59e0b; color: white; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer; text-decoration: none;" title="Edit Admin">
                            <i class="fas fa-edit"></i>
                        </a>
                        
                        <form action="{{ route('superadmin.admin.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: #ef4444; color: white; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer;" title="Hapus Admin">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection