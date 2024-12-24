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
        // DB::table('users')->insert([
        //     [
        //         'email' => 'mahasiswa1@example.com',
        //         'role' => 1,
        //         'password' => Hash::make('password123'), // Encrypted password
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'email' => 'mahasiswa2@example.com',
        //         'role' => 1,
        //         'password' => Hash::make('password123'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'email' => 'mahasiswa3@example.com',
        //         'role' => 1,
        //         'password' => Hash::make('password123'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'email' => 'mahasiswa4@example.com',
        //         'role' => 1,
        //         'password' => Hash::make('password123'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'email' => 'mahasiswa5@example.com',
        //         'role' => 1,
        //         'password' => Hash::make('password123'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // Insert 1 user with role 2 (Perusahaan)
        //     [
        //         'email' => 'perusahaan@example.com',
        //         'role' => 2,
        //         'password' => Hash::make('password123'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],

        //     // Insert 1 user with role 3 (Admin)
        //     [
        //         'email' => 'admin@example.com',
        //         'role' => 3,
        //         'password' => Hash::make('password123'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // ]);

        DB::table('users')->insert([
            [
                'email' => 'johndoe@gmail.com',
                'password' => '$2y$12$.6m2x.tivwYekqAhHbQ.xe2RHz.TBvW03s9wuon1lkKQbR48iQKJO',
                'role' => 1,
                'email_verified_at' => now()
            ],
            [
                'email' => 'ptsukamaju@gmail.com',
                'password' => '$2y$12$D/weWAHjZkRdcsdfLJZeBeSWLOegzUPUWA98Y63kZTye1clpZXNeK',
                'role' => 2,
                'email_verified_at' => now()
            ]
        ]);

        DB::table('profile')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'photo_profile' => 'default/profile.png',
        ]);

        DB::table('profile')->insert([
            'first_name' => 'PT',
            'last_name' => 'Suka Maju',
            'photo_profile' => 'default/profile_company.jpg',
        ]);

        DB::table('student')->insert([
            'nim' => '4342401090',
            'id_user' => 1,
            'id_profile' => 1,
            // 'id_major' => 3,
            // 'id_study_program' => 2,
            'institute' => 'Politenik Negeri Batam'
        ]);

        DB::table('company')->insert([
            'nib' => '8473829132',
            'id_user' => 2,
            'id_profile' => 2,
            'cooperation_file' => 'file.pdf'
        ]);
    }
}
