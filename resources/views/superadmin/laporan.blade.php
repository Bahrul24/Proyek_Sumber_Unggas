@extends('layouts.superadmin')

@section('title', 'Laporan Aktivitas - Super Admin')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 25px;">
        <div>
            <h2 style="color: #1e293b; font-size: 1.5rem; margin: 0;">Laporan Aktivitas Sistem</h2>
            <p style="color: #64748b; margin: 5px 0 0 0;">Pantau jejak aktivitas dan riwayat perubahan data oleh semua admin.</p>
        </div>
        <button style="background: #10b981; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fas fa-download"></i> Export PDF
        </button>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 15px; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Waktu</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">User / Admin</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Aktivitas</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; text-transform: uppercase; font-size: 0.85rem;">Keterangan / Detail</th>
                </tr>
            </thead>
            <tbody>
                {{-- Gunakan data dari database jika nanti sudah punya tabel logs/aktivitas --}}
                @forelse($aktivitas as $log)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">
                            {{ $log->created_at->format('d M Y, H:i') }}
                        </td>
                        <td style="padding: 15px; font-weight: 500; color: #1e293b;">
                            {{ $log->user_name ?? 'Sistem' }}
                        </td>
                        <td style="padding: 15px;">
                            <span style="background: #e2e8f0; color: #475569; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                {{ $log->aksi }}
                            </span>
                        </td>
                        <td style="padding: 15px; color: #475569;">
                            {{ $log->keterangan }}
                        </td>
                    </tr>
                @empty
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">Hari ini, 10:25 WIB</td>
                        <td style="padding: 15px; font-weight: 500; color: #1e293b;">Bos Sumber Unggas</td>
                        <td style="padding: 15px;"><span style="background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Tambah Produk</span></td>
                        <td style="padding: 15px; color: #475569;">Menambahkan produk baru: "Test"</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">Kemarin, 15:30 WIB</td>
                        <td style="padding: 15px; font-weight: 500; color: #1e293b;">Admin Pakan</td>
                        <td style="padding: 15px;"><span style="background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">Login</span></td>
                        <td style="padding: 15px; color: #475569;">Berhasil login ke panel kendali.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection