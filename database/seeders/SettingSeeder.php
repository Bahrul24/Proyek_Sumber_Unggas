<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['key' => 'nama_toko', 'value' => 'Sumber Unggas'],
            ['key' => 'email_kontak', 'value' => 'info@sumberunggas.com'],
            ['key' => 'no_telp', 'value' => '0812-3456-7890'],
            ['key' => 'alamat', 'value' => 'Jl. Raya Peternakan No. 123, Madiun'],
            ['key' => 'status_web', 'value' => 'aktif'],
        ];

        foreach ($data as $item) {
            \App\Models\Setting::updateOrCreate(['key' => $item['key']], $item);
        }
    }
}
