<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;
use App\Models\User;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $waliUsers = User::role('wali')->pluck('id')->toArray();

        if (empty($waliUsers)) {
            for ($i = 1; $i <= 10; $i++) {
                $wali = User::create([
                    'name' => "Wali {$i}",
                    'email' => "wali{$i}@example.com",
                    'password' => Hash::make('password'),
                ]);
                $wali->assignRole('wali');
                $waliUsers[] = $wali->id;
            }
        }

        $kelas = DB::table('kelas')->pluck('id')->toArray();
        if (empty($kelas)) {
            $kelas = [
                DB::table('kelas')->insertGetId([
                    'nama' => 'XII RPL 1',
                    'kompetensi_keahlian' => 'Rekayasa Perangkat Lunak',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]),
                DB::table('kelas')->insertGetId([
                    'nama' => 'XII TKJ 1',
                    'kompetensi_keahlian' => 'Teknik Komputer dan Jaringan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]),
            ];
        }

        for ($i = 1; $i <= 20; $i++) {
            DB::table('siswas')->insert([
                'nisn' => $faker->unique()->numerify('00########'),
                'nis' => $faker->unique()->numerify('2023####'),
                'nama' => $faker->firstName() . ' ' . $faker->lastName(),
                'id_kelas' => $faker->randomElement($kelas),
                'alamat' => $faker->address(),
                'telepon' => $faker->numerify('08##########'),
                'foto' => null,
                'user_id' => $faker->unique()->randomElement($waliUsers),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

}
