<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil UsersTableSeeder untuk memasukkan data ke tabel users
        $this->call(UserRolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(JurusanSeeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(LowonganSeeder::class);
        $this->call(LowonganProdiSeeder::class);
    }
}
