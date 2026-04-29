@extends('layouts.superadmin')

@section('title', 'Laporan Aktivitas - Super Admin')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 25px;">
        <div>
            <h2 style="color: #1e293b; font-size: 1.5rem; margin: 0;">Laporan Aktivitas Sistem</h2>
            <p style="color: #64748b; margin: 5px 0 0 0;">Pantau jejak aktivitas dan riwayat perubahan data oleh semua admin.</p>
        </div>
        
        <a href="{{ route('superadmin.laporan.pdf', request()->all()) }}" style="background: #10b981; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
            <i class="fas fa-download"></i> Export PDF
        </a>
    </div>

    <div style="background: white; border-radius: 12px; padding: 20px; margin-bottom: 20px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <form action="{{ route('superadmin.laporan') }}" method="GET" style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 200px;">
                <label for="start_date" style="display: block; margin-bottom: 5px; color: #475569; font-weight: 500; font-size: 0.9rem;">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; color: #1e293b;">
            </div>
            <div style="flex: 1; min-width: 200px;">
                <label for="end_date" style="display: block; margin-bottom: 5px; color: #475569; font-weight: 500; font-size: 0.9rem;">Tanggal Akhir</label>
                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; color: #1e293b;">
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: #3b82f6; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; cursor: pointer;">
                    Filter
                </button>
                <a href="{{ route('superadmin.laporan') }}" style="background: #e2e8f0; color: #475569; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; display: inline-block;">
                    Reset
                </a>
            </div>
        </form>
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
                @forelse($aktivitas as $log)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">
                            {{ $log->created_at->format('d M Y, H:i') }}
                        </td>
                        <td style="padding: 15px; font-weight: 500; color: #1e293b;">
                            {{ $log->user->name ?? 'Admin' }}
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
                    <tr>
                        <td colspan="4" style="padding: 20px; text-align: center; color: #64748b;">
                            Tidak ada data aktivitas pada rentang tanggal ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection