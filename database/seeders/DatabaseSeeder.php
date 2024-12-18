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
<<<<<<< HEAD
        DB::table('users')->insert([
            [
                'id_user' => 1,
                'email' => '',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'created_date' => date('Y-m-d', time()),
                'email_verified_at' => date('Y-m-d', time()),
            ],
            [
                'id_user' => 2,
                'email' => 'janedoe@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'created_date' => date('Y-m-d', time()),
                'email_verified_at' => date('Y-m-d', time()),
            ],
            [
                'id_user' => 3,
                'email' => 'bobharold556@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'created_date' => date('Y-m-d', time()),
                'email_verified_at' => date('Y-m-d', time()),
            ],
            [
                'id_user' => 4,
                'email' => 'ptsukamaju@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'company',
                'created_date' => date('Y-m-d', time()),
                'email_verified_at' => date('Y-m-d', time()),
            ],
            [
                'id_user' => 5,
                'email' => 'ptcakraindonesia@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'company',
                'created_date' => date('Y-m-d', time()),
                'email_verified_at' => date('Y-m-d', time()),
            ],
            [
                'id_user' => 6,
                'email' => 'rainpolibatam@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_date' => date('Y-m-d', time()),
                'email_verified_at' => date('Y-m-d', time()),
            ],
        ]);


        DB::table('profile')->insert([
            [
                'id_profile'    => 1,
                'photo_profile' => 'default/profile1.jpg',
                'first_name'    => 'John',
                'last_name'     => 'Doe',
                'location'      => 'New York',
                'postal_code'   => '10001',
                'city'          => 'New York City',
                'phone_number'  => '1234567890',
                'description'   => 'A software engineer from NY',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id_profile'    => 2,
                'photo_profile' => 'default/profile.jpg',
                'first_name'    => 'Jane',
                'last_name'     => 'Doe',
                'location'      => 'California',
                'postal_code'   => '90001',
                'city'          => 'Los Angeles',
                'phone_number'  => '0987654321',
                'description'   => 'A content creator from LA',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id_profile'    => 3,
                'photo_profile' => 'default/profile.jpg',
                'first_name'    => 'Bob',
                'last_name'     => 'Harold',
                'location'      => 'Texas',
                'postal_code'   => '73301',
                'city'          => 'Austin',
                'phone_number'  => '5678901234',
                'description'   => 'A graphic designer based in Austin',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id_profile'    => 4,
                'photo_profile' => 'default/profile.jpg',
                'first_name'    => 'PT',
                'last_name'     => 'Suka Maju',
                'location'      => 'Indonesia, Batam Nongsa',
                'postal_code'   => '33101',
                'city'          => 'Batam',
                'phone_number'  => '089284098212',
                'description'   => 'Bergerak di bidang internet',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id_profile'    => 5,
                'photo_profile' => 'default/profile.jpg',
                'first_name'    => 'PT',
                'last_name'     => 'Cakra Indonesia',
                'location'      => 'Indonesia, Batam Batu aji',
                'postal_code'   => '60601',
                'city'          => 'Batam',
                'phone_number'  => '7890123456',
                'description'   => 'Mempersatukan bangsa menuju cakrawala',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id_profile'    => 6,
                'photo_profile' => 'default/profile.jpg',
                'first_name'    => 'Rain',
                'last_name'     => 'Polibatam Admin',
                'location'      => 'Indonesia, Batam Batam Center',
                'postal_code'   => '89101',
                'city'          => 'Batam',
                'phone_number'  => '6789012345',
                'description'   => 'Admin Website Rain Politeknik Negeri Batam',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
        

        // DB::table('company')->insert([
        //     [
        //         'nib' => '9287012841',
        //         'id_profile' => 4,
        //         'id_user' => 4,
        //         'cooperation_file' => 'file_kerjasama.pdf',
        //         'type' => 'PT',
        //         'business_fields' => 'Internet Service Provider',
        //         'founded_date' => '2000-12-09',
        //         'status_verified_at' => '2020-03-12'
        //     ],
        //     [
        //         'nib' => '1829038712',
        //         'id_profile' => 5,
        //         'id_user' => 5,
        //         'cooperation_file' => 'file_kerjasama.pdf',
        //         'type' => 'PT',
        //         'business_fields' => 'Digital Marketing Agency',
        //         'founded_date' => '2010-04-11',
        //         'status_verified_at' => '2019-10-01'
        //     ],
        // ]);

        DB::table('student')->insert([
            [
                'nim' => '4342401034',
                'id_profile' => 1,
                'id_user' => 1,
                'institue' => 'Politeknik Negeri Batam',
                'study_program' => 'Teknologi Rekayas Perangkat Lunak',
                'major' => 'Tenkik Informatika',
                'skill' => 'Membuat mobile application'
            ],
            [
                'nim' => '4342401035',
                'id_profile' => 2,
                'id_user' => 2,
                'institue' => 'Politeknik Negeri Batam',
                'study_program' => 'Teknologi Rekyasa Multimedia',
                'major' => 'Tenkik Informatika',
                'skill' => null
            ],
            [
                'nim' => '4342401036',
                'id_profile' => 3,
                'id_user' => 3,
                'institue' => 'Politeknik Negeri Batam',
                'study_program' => 'Teknik Perawatan Pesawat Udara',
                'major' => 'Tenkik Mesin',
                'skill' => null
            ],
        ]);

        // DB::table('admin')->insert([
        //     [
        //         'nim' => '4342401034',
        //         'id_profile' => 1,
        //         'id_user' => 1,
        //         'institute' => 'Politeknik Negeri Batam',
        //         'privileges' => "INSERT, UPDATE, DELETE, SELECT"
        //     ],
        // ]);

        // User::factory(1)->create();
        // Profile::factory(1)->create();
        // Company::factory(1)->create();

        Vacancy::factory(10)
            ->randSalary()
            ->randTimeTypeAndType()
            ->randMajor()
            ->create();
=======
        // Memanggil UsersTableSeeder untuk memasukkan data ke tabel users
        $this->call(UserRolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MajorSeeder::class);
        $this->call(StudyProgramSeeder::class);
>>>>>>> fix/conflict
    }
}
