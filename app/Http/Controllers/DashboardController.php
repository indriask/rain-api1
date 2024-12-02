<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->view('dashboard', [
            'role' => 'company'
        ]);
    }

    public function daftarLamaran()
    {
        return response()->view('student.daftar-lamaran', [
            'role' => 'student'
        ]);
    }

    public function getLamaranStatus(Request $request)
    {
        $lamaran = [
            [
                'title' => 'lamaranmu sedang di proses',
                'pesan' => 'Silahkan tunggu konfirmasi selanjutnya yaa!'
            ],
            ['title' => 'lamaranmu ditolak', 'pesan' => 'Silahkan tunggu konfirmasi selanjutnya yaa!'],
            ['title' => 'lamaranmu diterima', 'pesan' => 'Silahkan tunggu konfirmas selanjutnya yaa!']
        ];

        $ambilLamaran = $lamaran[rand(0, 2)];

        return response()->json(['data' => $ambilLamaran]);
    }

    public function getWawancaraStatus(Request $request) {
        return response()->json(['data' => 'Wawancara mu sedang di proses!']);
    }

    public function kelolaLowongan() {
        return response()->view('company.kelola-lowongan', [
            'role' => 'company'
        ]);
    }
}
