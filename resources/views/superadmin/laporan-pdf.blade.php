<!DOCTYPE html>
<html>
<head>
    <title>Laporan Aktivitas Sistem</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 5px; }
        p.subtitle { text-align: center; color: #555; margin-top: 0; }
    </style>
</head>
<body>
    <h2>Laporan Aktivitas Sistem</h2>
    <p class="subtitle">Riwayat Perubahan Data</p>

    <table>
        <thead>
            <tr>
                <th>Waktu</th>
                <th>User / Admin</th>
                <th>Aktivitas</th>
                <th>Keterangan / Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aktivitas as $log)
            <tr>
                <td>{{ $log->created_at->format('d M Y, H:i') }}</td>
                <td>{{ $log->user->name ?? 'Admin' }}</td>
                <td>{{ $log->aksi }}</td>
                <td>{{ $log->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>