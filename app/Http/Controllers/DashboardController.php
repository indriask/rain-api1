<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class DashboardController extends Controller
{
    /**
     * Method untuk me-render halaman dashboard mahasiswa, perusahaan dan admin
     */

    public function index($id = 0)
    {
        if(request()->hasHeader('x-get-data')) {
            $vacancies = Vacancy::with('company.profile')->get();
            return response()->json(['data' => $vacancies]);
        }

        if(request()->hasHeader('x-get-specific')) {
            $vacancy = Vacancy::with('company.profile')->find($id);
            return response()->json([
                'data' => $vacancy,
                'role' => auth('web')->user()->role
            ]);
        }
    
        $role = auth('web')->user()->role;
        $user = auth('web')->user()->load("$role.profile");

        return response()->view('dashboard', [
            'role' => $role,
            'user' => $user
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

     // Method untuk menampilkan halaman notifikasi email verifikasi sudah terkirim
    public function verifyRegisteredEmailPage() {
        return response()->view('auth.verify-email');
    }

    // Method untuk melakukan verifikasi email user
    public function verifyRegisteredEmail(EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('signin');
    }
}
