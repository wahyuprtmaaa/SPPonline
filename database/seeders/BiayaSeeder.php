<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BiayaSeeder extends Seeder
{
    public function run(): void
    {
        $biayas = [
            ['nama_biaya' => 'SPP Bulanan', 'jumlah' => 150000, 'status' => 1],
            ['nama_biaya' => 'Uang Gedung', 'jumlah' => 5000000, 'status' => 1],
            ['nama_biaya' => 'Biaya Kegiatan', 'jumlah' => 250000, 'status' => 1],
            ['nama_biaya' => 'Seragam Sekolah', 'jumlah' => 750000, 'status' => 1],
            ['nama_biaya' => 'Buku Paket', 'jumlah' => 600000, 'status' => 1],
        ];

        foreach ($biayas as $biaya) {
            DB::table('biayas')->insert([
                'nama_biaya' => $biaya['nama_biaya'],
                'jumlah' => $biaya['jumlah'],
                'status' => $biaya['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
