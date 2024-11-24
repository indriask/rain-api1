<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->delete();

        DB::table('user_roles')->insert([
            [
                'id' => 1,
                'label'=> 'Mahasiswa'
            ], [
                'id' => 2,
                'label'=> 'Perusahaan'
            ], [
                'id' => 3,
                'label'=> 'Admin'
            ]
        ]);
    }
}
