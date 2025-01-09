<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->insert([
            ['id_profile' => 19, 'id_user' => 19, 'institute' => 'Politeknik Negeri Batam', 'privilege' => 'rain_db.*:SELECT, INSERT, UPDATE, DELETE']
        ]);
    }
}
