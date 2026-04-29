<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('nama_produk');
        $table->string('kategori'); // pakan atau vaksin
        $table->integer('harga');
        $table->string('satuan');
        $table->integer('stok');
        $table->string('gambar'); // Untuk menyimpan path/nama file gambar
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
