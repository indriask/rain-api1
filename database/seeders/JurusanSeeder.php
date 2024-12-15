<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurusan')->insert([
            ['name' => 'Manajemen & Bisnis', 'created_at' => now(),
                'updated_at' => now()],
            ['name' => 'Teknik Elektro', 'created_at' => now(),
                'updated_at' => now()],
            ['name' => 'Teknik Informatika', 'created_at' => now(),
                'updated_at' => now()],
            ['name' => 'Teknik Mesin', 'created_at' => now(),
                'updated_at' => now()],
        ]);
    }
}
