<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return response()->view('dashboard');
    }

    public function detailLowongan(string $lowongan) {
        return response()->view('detail-lowongan', [
            'lowongan' => $lowongan
        ]);
    }

    public function pasangLowongan() {
        return response()->view('company.pasang-lowongan');
    }

    public function showDaftarLamaran() {
        return response()->view('student.daftar-lamaran');
    }
}
