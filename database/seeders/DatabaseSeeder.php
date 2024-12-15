<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Profile;
use App\Models\User;
use App\Models\Vacancy;
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
    }
}
