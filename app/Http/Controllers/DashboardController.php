<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Method untuk me-render halaman dashboard mahasiswa, perusahaan dan admin
     */
    public function index()
    {
        return response()->view('dashboard', [
            'role' => 'admin'
        ]);
    }

    /**
     * Method untuk me-render halaman daftar lamaran mahasiswa
     */
    public function studentProposalListPage() {
        return response()->view('student.daftar-lamaran', [
            'role' => 'student'
        ]);
    }

    /**
     * Mehod untuk me-render halaman profile mahasiswa
     */
    public function studentProfilePage() {
        return response()->view('student.profile', [
            'role' => 'student'
        ]);
    }

    /**
     * Method untuk me-render halaman kelola lowongan perusahaan
     */
    public function companyManageVacancyPage() {
        return response()->view('company.kelola-lowongan', [
            'role' => 'company'
        ]);
    }

    /**
     * Method untuk me-render halaman daftar pelamar lowongan perusahaan
     */
    public function companyApplicantPage() {
        return response()->view('company.daftar-pelamar', [
            'role' => 'company'
        ]);
    }

    /**
     * Method untuk me-render halaman profile perusahaan
     */
    public function companyProfilePage() {
        return response()->view('company.profile', [
            'role' => 'company'
        ]);
    }

    /**
     * Method untuk me-render halaman kelola lowongan admin
     */
    public function adminManageVacancyPage() {
        return response()->view('admin.kelola-lowongan', [
            'role' => 'admin'
        ]);
    }

    /**
     * Method untuk me-render halaman kelola akun mahasiswa
     */
    public function adminManageUserStudent() {
        return response()->view('admin.kelola-mahasiswa', [
            'role' => 'student'
        ]);
    }

    /**
     * Method untuk me-render halaman kelola akun perusahaan
     */
    public function adminManageUserCompany() {
        return response()->view('admin.kelola-perusahaan', [
            'role' => 'admin'
        ]);
    }
}
