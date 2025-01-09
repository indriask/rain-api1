<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company')->insert([
            [
                'nib' => '1647354321',
                'id_profile' => 10,
                'id_user' => 10,
                'type' => 'PT',
                'business_fields' => 'manufaktur hardware application dan system',
                'founded_date' => date('Y-m-d', strtotime('2019-01-13')),
                'cooperation_file' => 'cooperation_folder/SURAT KERJASAMA PT. AOHAI INDONESIA DAN POLIBATAM.docx',
                'status_verified_at' => date('Y-m-d', time())
            ],
            [
                'nib' => '8756431231',
                'id_profile' => 11,
                'id_user' => 11,
                'type' => 'PT',
                'business_fields' => 'manufaktur mesin berat',
                'founded_date' => date('Y-m-d', strtotime('2012-03-13')),
                'cooperation_file' => 'cooperation_folder/SURAT KERJASAMA PT. BATAM TECHNO INDONESIA DAN POLIBATAM.pdf',
                'status_verified_at' => date('Y-m-d', time())
            ],
            [
                'nib' => '9845563123',
                'id_profile' => 12,
                'id_user' => 12,
                'type' => 'PT',
                'business_fields' => 'jasa logistik',
                'founded_date' => date('Y-m-d', strtotime('2005-09-20')),
                'cooperation_file' => 'cooperation_folder/SURAT KERJASAMA PT. GLOBALINDO MULTILOGISTIK DAN POLIBATAM.pdf',
                'status_verified_at' => date('Y-m-d', time())
            ],
            [
                'nib' => '0983214321',
                'id_profile' => 13,
                'id_user' => 13,
                'type' => 'LPK',
                'business_fields' => 'LPK, Kursus dan pembelajaran',
                'founded_date' => date('Y-m-d', strtotime('2005-09-30')),
                'cooperation_file' => 'cooperation_folder/SURAT KERJASAMA INFINITE LEARNING DAN POLIBATAM.pdf',
                'status_verified_at' => date('Y-m-d', time())
            ],
            [
                'nib' => '7765902312',
                'id_profile' => 14,
                'id_user' => 14,
                'type' => 'PT',
                'business_fields' => 'bidang alat pancing dan sepeda',
                'founded_date' => date('Y-m-d', strtotime('2010-10-11')),
                'cooperation_file' => 'cooperation_folder/SURAT KERJASAMA PT. SHIMANO BATAM DAN POLIBATAM.pdf',
                'status_verified_at' => date('Y-m-d', time())
            ],
            [
                'nib' => '6648921221',
                'id_profile' => 15,
                'id_user' => 15,
                'type' => 'PT',
                'business_fields' => 'bidang kesehatan',
                'founded_date' => date('Y-m-d', strtotime('2011-02-5')),
                'cooperation_file' => 'cooperation_folder/SURAT KERJASAMA PT. CIBA ALCON BATAM DAN POLIBATAM.pdf',
                'status_verified_at' => date('Y-m-d', time())
            ],
            [
                'nib' => '8864099912',
                'id_profile' => 16,
                'id_user' => 16,
                'type' => 'PT',
                'business_fields' => 'manufaktur jaringan dan teknologi',
                'founded_date' => date('Y-m-d', strtotime('2017-04-18')),
                'cooperation_file' => 'cooperation_folder/SURAT KERJASAMA TELKOM INDONESIA DAN POLIBATAM.pdf',
                'status_verified_at' => date('Y-m-d', time())
            ],
            [
                'nib' => '0983647321',
                'id_profile' => 17,
                'id_user' => 17,
                'type' => 'PT',
                'business_fields' => 'manufaktur mekanik',
                'founded_date' => date('Y-m-d', strtotime('2007-04-18')),
                'cooperation_file' => 'cooperation_folder/SURAT KERJASAMA PT. NOK FREUDENBERG DAN POLIBATAM.pdf',
                'status_verified_at' => date('Y-m-d', time())
            ],
            [
                'nib' => '2309817463',
                'id_profile' => 18,
                'id_user' => 18,
                'type' => 'PT',
                'business_fields' => 'Manufacturing, Transport & Logistics',
                'founded_date' => date('Y-m-d', strtotime('2013-01-26')),
                'cooperation_file' => 'cooperation_folder/SURAT KERJASAMA PT. AMBER KARYA DAN POLIBATAM.pdf',
                'status_verified_at' => date('Y-m-d', time())
            ],
        ]);
    }
}
