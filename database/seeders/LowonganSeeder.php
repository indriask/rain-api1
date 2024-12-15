<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LowonganSeeder extends Seeder
{
    public function run(): void
    {
        // Dapatkan ID jurusan berdasarkan nama
        $teknikInformatikaId = DB::table('jurusan')->where('name', 'Teknik Informatika')->value('id');
        $teknikMesinId = DB::table('jurusan')->where('name', 'Teknik Mesin')->value('id');
        $manajemenBisnisId = DB::table('jurusan')->where('name', 'Manajemen & Bisnis')->value('id');
        $teknikElektroId = DB::table('jurusan')->where('name', 'Teknik Elektro')->value('id');

        // Insert data lowongan
        DB::table('lowongan')->insert([
            // Lowongan untuk Teknik Informatika
            [
                'nama_pekerjaan' => 'Software Developer',
                'id_jurusan' => $teknikInformatikaId,
                'gaji_perbulan' => 8000000,
                'nama_perusahaan' => 'PT Teknologi Masa Depan',
                'tanggal_pendaftaran' => '2024-12-20',
                'lokasi' => 'Jakarta',
                'jumlah_kouta' => 5,
                'jenis_kerja' => 'Fulltime',
                'mode_kerja' => 'Hybrid',
                'lama_magang' => '6 bulan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_pekerjaan' => 'Web Designer Intern',
                'id_jurusan' => $teknikInformatikaId,
                'gaji_perbulan' => 5000000,
                'nama_perusahaan' => 'PT Kreatif Digital',
                'tanggal_pendaftaran' => '2024-12-22',
                'lokasi' => 'Bandung',
                'jumlah_kouta' => 3,
                'jenis_kerja' => 'Partime',
                'mode_kerja' => 'Offline',
                'lama_magang' => '4 bulan',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Lowongan untuk Teknik Mesin
            [
                'nama_pekerjaan' => 'Mechanical Engineer Intern',
                'id_jurusan' => $teknikMesinId,
                'gaji_perbulan' => 4000000,
                'nama_perusahaan' => 'PT Mesin Sejahtera',
                'tanggal_pendaftaran' => '2024-12-25',
                'lokasi' => 'Surabaya',
                'jumlah_kouta' => 3,
                'jenis_kerja' => 'Partime',
                'mode_kerja' => 'Offline',
                'lama_magang' => '3 bulan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_pekerjaan' => 'CNC Operator',
                'id_jurusan' => $teknikMesinId,
                'gaji_perbulan' => 7000000,
                'nama_perusahaan' => 'PT Precision Tools',
                'tanggal_pendaftaran' => '2024-12-28',
                'lokasi' => 'Karawang',
                'jumlah_kouta' => 2,
                'jenis_kerja' => 'Fulltime',
                'mode_kerja' => 'Offline',
                'lama_magang' => '5 bulan',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Lowongan untuk Manajemen & Bisnis
            [
                'nama_pekerjaan' => 'Marketing Intern',
                'id_jurusan' => $manajemenBisnisId,
                'gaji_perbulan' => 4500000,
                'nama_perusahaan' => 'PT Bisnis Hebat',
                'tanggal_pendaftaran' => '2024-12-15',
                'lokasi' => 'Jakarta',
                'jumlah_kouta' => 4,
                'jenis_kerja' => 'Fulltime',
                'mode_kerja' => 'Online',
                'lama_magang' => '3 bulan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_pekerjaan' => 'Finance Analyst Intern',
                'id_jurusan' => $manajemenBisnisId,
                'gaji_perbulan' => 6000000,
                'nama_perusahaan' => 'PT Keuangan Cerdas',
                'tanggal_pendaftaran' => '2024-12-18',
                'lokasi' => 'Jakarta',
                'jumlah_kouta' => 2,
                'jenis_kerja' => 'Partime',
                'mode_kerja' => 'Hybrid',
                'lama_magang' => '4 bulan',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Lowongan untuk Teknik Elektro
            [
                'nama_pekerjaan' => 'Electrical Engineer',
                'id_jurusan' => $teknikElektroId,
                'gaji_perbulan' => 7500000,
                'nama_perusahaan' => 'PT Elektro Hebat',
                'tanggal_pendaftaran' => '2024-12-20',
                'lokasi' => 'Bekasi',
                'jumlah_kouta' => 3,
                'jenis_kerja' => 'Fulltime',
                'mode_kerja' => 'Offline',
                'lama_magang' => '6 bulan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_pekerjaan' => 'Embedded Systems Intern',
                'id_jurusan' => $teknikElektroId,
                'gaji_perbulan' => 5000000,
                'nama_perusahaan' => 'PT Elektronik Canggih',
                'tanggal_pendaftaran' => '2024-12-30',
                'lokasi' => 'Semarang',
                'jumlah_kouta' => 2,
                'jenis_kerja' => 'Partime',
                'mode_kerja' => 'Hybrid',
                'lama_magang' => '4 bulan',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
