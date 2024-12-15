<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert 5 users with role 1 (Mahasiswa)
        DB::table('users')->insert([
            [
                'email' => 'mahasiswa1@example.com',
                'role' => 1,
                'password' => Hash::make('password123'), // Encrypted password
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'mahasiswa2@example.com',
                'role' => 1,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'mahasiswa3@example.com',
                'role' => 1,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'mahasiswa4@example.com',
                'role' => 1,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'mahasiswa5@example.com',
                'role' => 1,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Insert 1 user with role 2 (Perusahaan)
            [
                'email' => 'perusahaan@example.com',
                'role' => 2,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Insert 1 user with role 3 (Admin)
            [
                'email' => 'admin@example.com',
                'role' => 3,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
