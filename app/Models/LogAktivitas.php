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
}
