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
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->string('user_name'); // Nama admin yang melakukan aktivitas
            $table->string('aksi');      // Jenis aktivitas (Contoh: "Tambah Produk", "Edit Produk")
            $table->text('keterangan');  // Detail aktivitas (Contoh: "Menambahkan produk pakan...")
            $table->timestamps();        // Otomatis membuat kolom created_at (Waktu)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};
