<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Pastikan model User dipanggil

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Membuat Akun Super Admin
        User::create([
            'name' => 'Bos Sumber Unggas',
            'email' => 'superadmin@sumberunggas.com',
            'password' => Hash::make('password123'), // Password akan dienkripsi
            'role' => 'super_admin',
            'status' => 'aktif',
        ]);

        // 2. Membuat Akun Admin Biasa
        User::create([
            'name' => 'Admin Pakan',
            'email' => 'admin@sumberunggas.com',
            'password' => Hash::make('password123'), // Password akan dienkripsi
            'role' => 'admin',
            'status' => 'aktif',
        ]);
    }
}