<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Psy\CodeCleaner\PassableByReferencePass;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // akun user mahasiswa
        DB::table('users')->insert([
            ['email' => 'wasyn@gmail.com', 'password' => bcrypt('password123'), 'role' => 1, 'email_verified_at' => now()],
            ['email' => 'eric@gmail.com', 'password' => bcrypt('password123'), 'role' => 1, 'email_verified_at' => now()],
            ['email' => 'aidil@gmail.com', 'password' => bcrypt('password123'), 'role' => 1, 'email_verified_at' => now()],
            ['email' => 'fito@gmail.com', 'password' => bcrypt('password123'), 'role' => 1, 'email_verified_at' => now()],
            ['email' => 'indria@gmail.com', 'password' => bcrypt('password123'), 'role' => 1, 'email_verified_at' => now()],
            ['email' => 'winda@gmail.com', 'password' => bcrypt('password123'), 'role' => 1, 'email_verified_at' => now()],
            ['email' => 'andri@gmail.com', 'password' => bcrypt('password123'), 'role' => 1, 'email_verified_at' => now()],
            ['email' => 'doni@gmail.com', 'password' => bcrypt('password123'), 'role' => 1, 'email_verified_at' => now()],
            ['email' => 'hasan@gmail.com', 'password' => bcrypt('password123'), 'role' => 1, 'email_verified_at' => now()],
        ]);

        // akun user perusahaan
        DB::table('users')->insert([
            ['email' => 'ptaohai@gmail.com', 'password' => bcrypt('password123'), 'role' => 2, 'email_verified_at' => now()],
            ['email' => 'ptbatamtechnoindonesia@gmail.com', 'password' => bcrypt('password123'), 'role' => 2, 'email_verified_at' => now()],
            ['email' => 'ptglobalindomultilogistik@gmail.com', 'password' => bcrypt('password123'), 'role' => 2, 'email_verified_at' => now()],
            ['email' => 'infinitelearningbatam@gmail.com', 'password' => bcrypt('password123'), 'role' => 2, 'email_verified_at' => now()],
            ['email' => 'ptshimanobatam@gmail.com', 'password' => bcrypt('password123'), 'role' => 2, 'email_verified_at' => now()],
            ['email' => 'ptcibaalconvision@gmail.com', 'password' => bcrypt('password123'), 'role' => 2, 'email_verified_at' => now()],
            ['email' => 'pttelkombatamindonesia@gmail.com', 'password' => bcrypt('password123'), 'role' => 2, 'email_verified_at' => now()],
            ['email' => 'ptnokfreudenberg@gmail.com', 'password' => bcrypt('password123'), 'role' => 2, 'email_verified_at' => now()],
            ['email' => 'ptamberkarya@gmail.com', 'password' => bcrypt('password123'), 'role' => 2, 'email_verified_at' => now()],
        ]);

        // akun user admin
        DB::table('users')->insert([
            ['email' => 'rainpolibatam@gmail.com', 'password' => bcrypt('password123'), 'role' => 3, 'email_verified_at' => now()],
        ]);
    }
}
