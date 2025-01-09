<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // profile unutk student
        DB::table('profile')->insert([
            [
                'id_profile' => 1,
                'photo_profile' => 'profile/Wasyn-removebg-preview.png',
                'first_name' => 'Wasyn',
                'last_name' => 'Sulaiman Siregar',
                'location' => 'Legenda Malaka',
                'postal_code' => '248743',
                'city' => 'Batam',
                'phone_number' => '0987543123'
            ],
            [
                'id_profile' => 2,
                'photo_profile' => 'profile/Eric-removebg-preview.png',
                'first_name' => 'Eric',
                'last_name' => 'Marchelino Hutabarat',
                'location' => 'Botania',
                'postal_code' => '244371',
                'city' => 'Batam',
                'phone_number' => '0898997543'
            ],
            [
                'id_profile' => 3,
                'photo_profile' => 'profile/Aidil-removebg-preview.png',
                'first_name' => 'Muhammad',
                'last_name' => 'Aidil Jupriadi Sale',
                'location' => 'Tanjung Piayu',
                'postal_code' => '248364',
                'city' => 'Batam',
                'phone_number' => '0844332561'
            ],
            [
                'id_profile' => 4,
                'photo_profile' => 'profile/Fito-removebg-preview.png',
                'first_name' => 'Fito',
                'last_name' => 'Desta Fabiansyah',
                'location' => 'Batu Ampar',
                'postal_code' => '231098',
                'city' => 'Batam',
                'phone_number' => '0899765482'
            ],
            [
                'id_profile' => 5,
                'photo_profile' => 'profile/Indria-removebg-preview.png',
                'first_name' => 'Indria',
                'last_name' => 'Bintani Aiska',
                'location' => 'Suka Jadi',
                'postal_code' => '230998',
                'city' => 'Batam',
                'phone_number' => '0891123211'
            ],
            [
                'id_profile' => 6,
                'photo_profile' => 'profile/Winda-removebg-preview.png',
                'first_name' => 'Winda',
                'last_name' => 'Tri Wulan Dari',
                'location' => 'Batu Aji',
                'postal_code' => '233451',
                'city' => 'Batam',
                'phone_number' => '0844563321'
            ],
            [
                'id_profile' => 7,
                'photo_profile' => 'profile/Screenshot 2025-01-04 215434.png',
                'first_name' => 'Andri',
                'last_name' => 'Putra Siregar',
                'location' => 'Legenda Bali',
                'postal_code' => '220098',
                'city' => 'Batam',
                'phone_number' => '0875667564'
            ],
            [
                'id_profile' => 8,
                'photo_profile' => 'profile/Screenshot 2025-01-04 215533.png',
                'first_name' => 'Doni',
                'last_name' => 'Tata Fahreza',
                'location' => 'Belian',
                'postal_code' => '233467',
                'city' => 'Batam',
                'phone_number' => '0878122231'
            ],
            [
                'id_profile' => 9,
                'photo_profile' => 'profile/Screenshot 2025-01-04 215619.png',
                'first_name' => 'Muhammad',
                'last_name' => 'Hasan Firdaus',
                'location' => 'Batu Aji',
                'postal_code' => '231166',
                'city' => 'Batam',
                'phone_number' => '0875901954'
            ],
        ]);

        // profile untuk perusahaan
        DB::table('profile')->insert([
            [
                'id_profile' => 10,
                'photo_profile' => 'profile/PT. AOHAI.jpeg',
                'first_name' => 'PT',
                'last_name' => 'Aohai',
                'location' => 'Legenda Malaka',
                'postal_code' => '248743',
                'city' => 'Batam',
                'phone_number' => '0888982312',
            ],
            [
                'id_profile' => 11,
                'photo_profile' => 'profile/PT. Batam Techno Indonesia.jpg',
                'first_name' => 'PT',
                'last_name' => 'Batam Techno Indonesia',
                'location' => 'Temenggung',
                'postal_code' => '244371',
                'city' => 'Batam',
                'phone_number' => '0899823317'
            ],
            [
                'id_profile' => 12,
                'photo_profile' => 'profile/PT. Globalindo Multilogistik.jpeg',
                'first_name' => 'PT',
                'last_name' => 'Globalindo multi logistik',
                'location' => 'Tanjung Piayu',
                'postal_code' => '248364',
                'city' => 'Batam',
                'phone_number' => '0845667312'
            ],
            [
                'id_profile' => 13,
                'photo_profile' => 'profile/Infinite Learning.jpg',
                'first_name' => 'Infinite',
                'last_name' => 'Learning',
                'location' => 'Bengkong',
                'postal_code' => '231098',
                'city' => 'Batam',
                'phone_number' => '0891211650'
            ],
            [
                'id_profile' => 14,
                'photo_profile' => 'profile/PT. Shimano Batam.png',
                'first_name' => 'Shimano',
                'last_name' => 'Batam',
                'location' => 'Tiban',
                'postal_code' => '230998',
                'city' => 'Batam',
                'phone_number' => '0845332120'
            ],
            [
                'id_profile' => 15,
                'photo_profile' => 'profile/PT. Ciba Alcon Vision Batam.png',
                'first_name' => 'Ciba',
                'last_name' => 'Alcon Batam',
                'location' => 'Nongsa',
                'postal_code' => '233451',
                'city' => 'Batam',
                'phone_number' => '0877659801'
            ],
            [
                'id_profile' => 16,
                'photo_profile' => 'profile/PT. Telkom Indonesia Batam.png',
                'first_name' => 'Telkom Batam',
                'last_name' => 'Indonesia',
                'location' => 'Nongsa',
                'postal_code' => '220098',
                'city' => 'Batam',
                'phone_number' => '0866540912'
            ],
            [
                'id_profile' => 17,
                'photo_profile' => 'profile/PT. Nok Freudenberg.jpg',
                'first_name' => 'PT NOK',
                'last_name' => 'FREUDENBERG',
                'location' => 'Tiban',
                'postal_code' => '233467',
                'city' => 'Batam',
                'phone_number' => '0876543908'
            ],
            [
                'id_profile' => 18,
                'photo_profile' => 'profile/PT. Amber Karya.jpg',
                'first_name' => 'PT',
                'last_name' => 'Amber Karya',
                'location' => 'Muka Kuning',
                'postal_code' => '231166',
                'city' => 'Batam',
                'phone_number' => '0876498012'
            ],
        ]);

        // profile untuk admin
        DB::table('profile')->insert([
            [
                'id_profile' => 19,
                'photo_profile' => 'default/profile_company.jpg',
                'first_name' => 'Admin',
                'last_name' => 'RAIN Polibatam',
                'location' => 'Batam Centre',
                'postal_code' => '289743',
                'city' => 'Batam',
                'phone_number' => '0822360917',
            ]
        ]);
    }
}
