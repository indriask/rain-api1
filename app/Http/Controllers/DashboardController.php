<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Lowongan;

class DashboardController extends Controller
{

    public function getJurusan()
    {
        return response()->json(Jurusan::all());
    }

    public function getProdi($idJurusan)
    {
        return response()->json(Prodi::where('id_jurusan', $idJurusan)->get());
    }

    public function getLokasi(){
        $lokasi = Lowongan::select('lokasi')->distinct()->get(); // Ambil kolom 'lokasi' dan pastikan hanya yang unik

    return response()->json($lokasi);
}

    public function filterLowongan(Request $request)
{
    $query = Lowongan::query();

    if ($request->filled('mode_kerja')) {
        $query->where('mode_kerja', 'like', '%' . $request->mode_kerja . '%');
    }

    if ($request->filled('lokasi')) {
        $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
    }

    if ($request->filled('search')) {
        $query->where('nama_pekerjaan', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('jurusan')) {
        $query->whereHas('jurusan', function ($q) use ($request) {
            $q->where('id', $request->jurusan);
        });
    }

    if ($request->filled('prodi')) {
        $query->whereHas('prodis', function ($q) use ($request) {
            $q->where('lowongan_prodi.prodi_id', $request->prodi); // Gunakan nama tabel pivot secara eksplisit
        });
    }
    
    $lowongan = $query->with('jurusan', 'prodis')->get();

    return response()->json($query->get());
}


    /**
     * Method untuk me-render halaman dashboard mahasiswa, perusahaan dan admin
     */
    public function index()
    {

    $lowongan = Lowongan::all();
        return response()->view('dashboard', [
            'role' => 'student',
            'lowongan' => $lowongan,
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
