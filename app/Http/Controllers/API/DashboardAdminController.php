<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    // Method untuk mem-proses logika delete lowongan
    public function deleteVacancy(Request $request) {
        
    }

    // Method untuk mem-proses logika kelola user mahasiswa
    public function manageUserStudent(Request $request) {

    }

    // Method untuk mem-proses logika kelola user perusahaan
    public function manageUserVacancy(Request $request) {
        
    }

    // method untuk menghapus akun user secara permanen
    public function deleteUser(Request $request) {
        return response()->json([
            "message" => "Berhasil menghapus akun!"
        ]);
    }
}

