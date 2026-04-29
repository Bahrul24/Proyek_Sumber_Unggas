<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Kolom yang diizinkan untuk diisi
    protected $fillable = [
    'nama_produk', 'kategori', 'harga', 'satuan', 'stok', 'gambar', 'is_unggulan', 'users_id'
];

}