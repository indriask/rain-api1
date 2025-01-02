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
                'email' => 'janedoe@gail.com',
                'password' => '$2y$12$pRC3y9jzMuO8A1Se62p.c.m6fVcC2zaUbiQ6UW43MOWi1EMXc1GB6',
                'role' => 1,
                'email_verified_at' => now()
            ],
            [
                'email' => 'ptsukamaju@gmail.com',
                'password' => '$2y$12$D/weWAHjZkRdcsdfLJZeBeSWLOegzUPUWA98Y63kZTye1clpZXNeK',
                'role' => 2,
                'email_verified_at' => now()
            ],
            [
                'email' => 'ptcitracahaya@gmail.com',
                'password' => '$2y$12$3lbb.oUyDx964U2N8QUlIeVwqlv37PKLTAHh.esuwnPp9ymH8qmou',
                'role' => 2,
                'email_verified_at' => now()
            ],
            [
                'email' => 'rain@gmail.com',
                'password' => '$2y$12$MwutUbK2Ztq9OtT9c7eCQuV02vpTjLrt36m/PzLr74qyhgGwbKyDS',
                'role' => 3,
                'email_verified_at' => now()
            ]
        ]);

        DB::table('profile')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'photo_profile' => 'default/profile.png',
        ]);

        DB::table('profile')->insert([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'photo_profile' => 'default/profile.png',
        ]);

        DB::table('profile')->insert([
            'first_name' => 'PT',
            'last_name' => 'Suka Maju',
            'photo_profile' => 'default/profile_company.jpg',
        ]);

        DB::table('profile')->insert([
            'first_name' => 'PT',
            'last_name' => 'Citra Cahaya',
            'photo_profile' => 'default/profile_company.jpg',
        ]);

        DB::table('profile')->insert([
            'first_name' => 'RAIN',
            'last_name' => 'POLIBATAM',
            'photo_profile' => 'default/profile.png',
        ]);

        DB::table('student')->insert([
            'nim' => '4342401090',
            'id_user' => 1,
            'id_profile' => 1,
            'id_major' => 3,
            'id_study_program' => 2,
            'institute' => 'Politenik Negeri Batam'
        ]);

        DB::table('student')->insert([
            'nim' => '4342401070',
            'id_user' => 2,
            'id_profile' => 2,
            'id_major' => 3,
            'id_study_program' => 2,
            'institute' => 'Politenik Negeri Batam'
        ]);

        DB::table('company')->insert([
            'nib' => '8473829132',
            'id_user' => 3,
            'id_profile' => 3,
            'cooperation_file' => 'cooperation_folder/file.pdf'
        ]);

        DB::table('company')->insert([
            'nib' => '3249018743',
            'id_user' => 4,
            'id_profile' => 4,
            'cooperation_file' => 'cooperation_folder/file.pdf'
        ]);

        DB::table('admin')->insert([
            'id_user' => 5,
            'id_profile' => 5,
            'institute' => 'Politeknik Negeri Batam',
            'privilege' => 'ALL:DELETE, SELECT, UPDATE'
        ]);
    }
}
