<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardStudentController extends Controller
{
    /**
     * Method untuk mem-proses logika melihat status lamaran mahasiswa
     */
    public function getProposalStatus(Request $request)
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

    /**
     * Method untuk mem-proses logika melihat status wawancara mahasiswa
     */
    public function getInterviewStatus(Request $request) {
        return response()->json(['data' => 'Wawancara mu sedang di proses!']);
    }
}
