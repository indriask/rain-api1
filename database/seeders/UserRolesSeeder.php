<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
                'label'=> 'Mahasiswa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => 2,
                'label'=> 'Perusahaan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id' => 3,
                'label'=> 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
