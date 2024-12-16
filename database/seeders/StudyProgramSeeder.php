<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dapatkan ID jurusan berdasarkan nama
        $teknikInformatikaId = DB::table('jurusan')->where('name', 'Teknik Informatika')->value('id');
        $teknikMesinId = DB::table('jurusan')->where('name', 'Teknik Mesin')->value('id');
        $manajemenBisnisId = DB::table('jurusan')->where('name', 'Manajemen & Bisnis')->value('id');
        $teknikElektroId = DB::table('jurusan')->where('name', 'Teknik Elektro')->value('id');

        // Masukkan data prodi ke tabel
        DB::table('prodi')->insert([
            [
                'id_jurusan' => $teknikInformatikaId,
                'name' => 'S1 Sistem Informasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jurusan' => $teknikInformatikaId,
                'name' => 'S1 Teknik Komputer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jurusan' => $teknikMesinId,
                'name' => 'S1 Teknik Otomotif',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jurusan' => $teknikMesinId,
                'name' => 'S1 Teknik Produksi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Prodi Manajemen dan Bisnis
            [
                'id_jurusan' => $manajemenBisnisId,
                'name' => 'S1 Manajemen Bisnis Internasional',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jurusan' => $manajemenBisnisId,
                'name' => 'S1 Kewirausahaan',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Prodi Teknik Elektro
            [
                'id_jurusan' => $teknikElektroId,
                'name' => 'S1 Teknik Tenaga Listrik',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_jurusan' => $teknikElektroId,
                'name' => 'S1 Teknik Telekomunikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
