<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil UsersTableSeeder untuk memasukkan data ke tabel users
        $this->call(UserRolesSeeder::class);
        $this->call(MajorSeeder::class);
        $this->call(StudyProgramSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(AdminSeeder::class);
    }
}
