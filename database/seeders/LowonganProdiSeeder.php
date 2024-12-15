<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LowonganProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('lowongan_prodi')->insert([

            // Relasi untuk lowongan 2 (Mechanical Engineer Intern)
            ['lowongan_id' => 1, 'prodi_id' => 1, 'created_at' => now(),
                'updated_at' => now()],
            ['lowongan_id' => 1, 'prodi_id' => 2, 'created_at' => now(),
                'updated_at' => now()], // Contoh multi-prodi
            ['lowongan_id' => 2, 'prodi_id' => 2, 'created_at' => now(),
                'updated_at' => now()], // Contoh multi-prodi
            ['lowongan_id' => 3, 'prodi_id' => 3, 'created_at' => now(),
                'updated_at' => now()], // Contoh multi-prodi
            ['lowongan_id' => 4, 'prodi_id' => 4, 'created_at' => now(),
                'updated_at' => now()], // Contoh multi-prodi
            ['lowongan_id' => 4, 'prodi_id' => 4, 'created_at' => now(),
                'updated_at' => now()], // Contoh multi-prodi

            ['lowongan_id' => 5, 'prodi_id' => 5, 'created_at' => now(),
                'updated_at' => now()], // Contoh multi-prodi
            ['lowongan_id' => 6, 'prodi_id' => 6, 'created_at' => now(),
                'updated_at' => now()], // Contoh multi-prodi
            ['lowongan_id' => 7, 'prodi_id' => 8, 'created_at' => now(),
                'updated_at' => now()], // Contoh multi-prodi
            ['lowongan_id' => 7, 'prodi_id' => 8, 'created_at' => now(),
                'updated_at' => now()], // Contoh multi-prodi

        ]);
    }
}
