<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    use HasFactory;

    // Pastikan nama tabelnya benar
    protected $table = 'log_aktivitas';

    // Kolom yang diizinkan untuk diisi
    protected $fillable = [
        'users_id',
        'aksi',
        'keterangan',
    ];

    public function user()
    {
        // Relasi bahwa log aktivitas ini dimiliki oleh (belongsTo) seorang User
        // 'users_id' adalah nama kolom foreign key di tabel log_aktivitas
        return $this->belongsTo(User::class, 'users_id');
    }
}
