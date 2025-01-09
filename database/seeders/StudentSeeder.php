<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // data student untuk akun role student
        DB::table('student')->insert([
            ['nim' => '4342401034', 'id_profile' => 1, 'id_user' => 1, 'id_major' => 3, 'id_study_program' => 6, 'skill' => 'Membaut website responsive'],
            ['nim' => '4342401060', 'id_profile' => 2, 'id_user' => 2, 'id_major' => 3, 'id_study_program' => 6, 'skill' => 'Membaut website responsive'],
            ['nim' => '4342401042', 'id_profile' => 3, 'id_user' => 3, 'id_major' => 3, 'id_study_program' => 6, 'skill' => 'Membaut website responsive'],
            ['nim' => '4342401050', 'id_profile' => 4, 'id_user' => 4, 'id_major' => 3, 'id_study_program' => 6, 'skill' => 'Membaut website responsive'],
            ['nim' => '4342401047', 'id_profile' => 5, 'id_user' => 5, 'id_major' => 3, 'id_study_program' => 6, 'skill' => 'Membaut website responsive'],
            ['nim' => '4342401056', 'id_profile' => 6, 'id_user' => 6, 'id_major' => 3, 'id_study_program' => 6, 'skill' => 'Membaut website responsive'],
            ['nim' => '4342401010', 'id_profile' => 7, 'id_user' => 7, 'id_major' => 3, 'id_study_program' => 6, 'skill' => 'Membaut website responsive'],
            ['nim' => '4342401043', 'id_profile' => 8, 'id_user' => 8, 'id_major' => 3, 'id_study_program' => 6, 'skill' => 'Membaut website responsive'],
            ['nim' => '4342401066', 'id_profile' => 9, 'id_user' => 9, 'id_major' => 3, 'id_study_program' => 6, 'skill' => 'Membaut website responsive'],
        ]);
    }
}
