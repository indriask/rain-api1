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
        $teknikInformatikaId = DB::table('major')->where('name', 'Teknik Informatika')->value('id');
        $teknikMesinId = DB::table('major')->where('name', 'Teknik Mesin')->value('id');
        $manajemenBisnisId = DB::table('major')->where('name', 'Manajemen & Bisnis')->value('id');
        $teknikElektroId = DB::table('major')->where('name', 'Teknik Elektro')->value('id');

        // prodi teknik informatika
        DB::table('study_program')->insert([
            ['id_major' => $teknikInformatikaId, 'name' => 'Diploma 3 Teknik Informatika'],
            ['id_major' => $teknikInformatikaId, 'name' => 'Diploma 3 Teknologi Geomatika'],
            ['id_major' => $teknikInformatikaId, 'name' => 'Sarjana Terapan Animasi'],
            ['id_major' => $teknikInformatikaId, 'name' => 'Sarjana Terapan Teknologi Rekayasa Multimedia'],
            ['id_major' => $teknikInformatikaId, 'name' => 'Sarjana Terapan Rekayasa Keamanan Siber'],
            ['id_major' => $teknikInformatikaId, 'name' => 'Sarjana Terapan Rekayasa Perangkat Lunak'],
            ['id_major' => $teknikInformatikaId, 'name' => 'Magister Terapan (S2) Rekayasa / Teknik Komputer'],
            ['id_major' => $teknikInformatikaId, 'name' => 'Sarjana Terapan Teknologi Permainan'],
        ]);

        // prodi manajemen dan bisnis
        DB::table('study_program')->insert([
            ['id_major' => $manajemenBisnisId, 'name' => 'Diploma 3 Akuntansi'],
            ['id_major' => $manajemenBisnisId, 'name' => 'Sarjana Terapan Akuntansi Manajerial'],
            ['id_major' => $manajemenBisnisId, 'name' => 'Sarjana Terapan Administrasi Bisnis Terapan'],
            ['id_major' => $manajemenBisnisId, 'name' => 'Sarjana Terapan Logistik Perdagangan Internasional'],
            ['id_major' => $manajemenBisnisId, 'name' => 'Sarjana Terapan Administrasi Bisnis Terapan (International Class)'],
            ['id_major' => $manajemenBisnisId, 'name' => 'Program Studi D2 Jalur Cepat Distribusi Barang'],
        ]);

        // prodi teknik elektro
        DB::table('study_program')->insert([
            ['id_major' => $teknikElektroId, 'name' => 'Diploma 3 Teknik Elektronika Manufaktur'],
            ['id_major' => $teknikElektroId, 'name' => 'Sarjana Terapan Teknologi Rekayasa Elektronika'],
            ['id_major' => $teknikElektroId, 'name' => 'Diploma 3 Teknik Instrumentasi'],
            ['id_major' => $teknikElektroId, 'name' => 'Sarjana Terapan Teknik Mekatronika'],
            ['id_major' => $teknikElektroId, 'name' => 'Sarjana Terapan Teknologi Rekayasa Pembangkit Energi'],
            ['id_major' => $teknikElektroId, 'name' => 'Sarjana Terapan Teknologi Rekayasa Robotika'],
        ]);

        // prodi teknik mesin
        DB::table('study_program')->insert([
            ['id_major' => $teknikMesinId, 'name' => 'Diploma 3 Teknik Mesin'],
            ['id_major' => $teknikMesinId, 'name' => 'Diploma 3 Teknik Perawatan Pesawat Udara'],
            ['id_major' => $teknikMesinId, 'name' => 'Sarjana Terapan Teknologi Rekayasa Konstruksi Perkapalan'],
            ['id_major' => $teknikMesinId, 'name' => 'Sarjana Terapan Teknologi Rekayasa Pengelasan dan Fabrikasi'],
            ['id_major' => $teknikMesinId, 'name' => 'Program Profesi Insinyur (PSPPI)'],
            ['id_major' => $teknikMesinId, 'name' => 'Sarjana Terapan Teknologi Rekayasa Metalurgi'],
        ]);
    }
}
