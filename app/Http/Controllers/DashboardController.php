<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->view('dashboard');
    }

    public function detailLowongan(string $lowongan)
    {
        return response()->view('detail-lowongan', [
            'lowongan' => $lowongan
        ]);
    }

    public function pasangLowongan()
    {
        return response()->view('company.pasang-lowongan');
    }

    public function showDaftarLamaran()
    {
        return response()->view('student.daftar-lamaran');
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
}
