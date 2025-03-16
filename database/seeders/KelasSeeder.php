<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kelas')->insert([
            [
                'nama' => 'XII RPL 1',
                'kompetensi_keahlian' => 'Rekayasa Perangkat Lunak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'XII TKJ 1',
                'kompetensi_keahlian' => 'Teknik Komputer dan Jaringan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
