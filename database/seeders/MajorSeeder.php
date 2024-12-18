<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('major')->insert([
            [
                'name' => 'Manajemen & Bisnis',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Teknik Elektro',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Teknik Mesin',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
