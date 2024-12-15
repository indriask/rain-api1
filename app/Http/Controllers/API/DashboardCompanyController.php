<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardCompanyController extends Controller
{
    /**
     * Method untuk mem-proses logika tambah lowongan
     * kak ini yg rain lama
     * kalo folder rain yang dari saya, aman kak ?
     * ga tau sih, nah itu pindahin deh kak keluarin dr folder magang itu
     * okay kak
     */
    public function tambahLowongan(Request $request) {}

    /**
     * Method untuk mem-proses logika edit lowongan
     */
    public function editVacancy(Request $request) {}

    /**
     * Method untuk mem-proses logika penghapusan lamaran
     */
    public function deleteApplicant(Request $request) {}

    /**
     * Method untuk mem-proses logika perbarui status pelamar
     */
    public function updateStatusApplicant(Request $request) {}
}
