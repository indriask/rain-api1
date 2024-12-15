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
        // DB::table('users')->insert([
        //     [
        //         'id_user' => 1,
        //         'email' => 'hosea@gmail.com',
        //         'password' => Hash::make('password123'),
        //         'role' => 'company',
        //         'created_date' => date('Y-m-d', time()),
        //         'email_verified_at' => date('Y-m-d', time()),
        //     ],
        //     [
        //         'id_user' => 2,
        //         'email' => 'eric@gmail.com',
        //         'password' => Hash::make('password123'),
        //         'role' => 'company',
        //         'created_date' => date('Y-m-d', time()),
        //         'email_verified_at' => date('Y-m-d', time()),
        //     ],
        // ]);


        // DB::table('profile')->insert([
        //     [
        //         'id_profile' => 1,
        //         'first_name' => 'Hosea',
        //         'last_name' => 'Corp',
        //         'photo_profile' => 'default/profile.jpg'
        //     ],
        //     [
        //         'id_profile' => 2,
        //         'first_name' => 'Eric',
        //         'last_name' => 'Corp',
        //         'photo_profile' => 'default/profile.jpg'
        //     ],
        // ]);

        // DB::table('company')->insert([
        //     [
        //         'nib' => '4342401034',
        //         'id_profile' => 1,
        //         'id_user' => 1,
        //         'cooperation_file' => 'file.pdf'
        //     ],
        //     [
        //         'nib' => '4342401090',
        //         'id_profile' => 2,
        //         'id_user' => 2,
        //         'cooperation_file' => 'file.pdf'
        //     ],
        // ]);

        User::factory(1)->create();
        Profile::factory(1)->create();
        Company::factory(1)->create();

        Vacancy::factory(10)
            ->randSalary()
            ->randTimeTypeAndType()
            ->randMajor()
            ->create();

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
