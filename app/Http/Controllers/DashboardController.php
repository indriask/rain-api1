<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\StudyProgram;

class DashboardController extends Controller
{
    protected $roles = ['student', 'company', 'admin'];

    public function getJurusan()
    {
        return response()->json(Major::all());
    }

    public function getProdi($idJurusan)
    {
        return response()->json(StudyProgram::where('id_major', $idJurusan)->get());
    }

    public function getLokasi()
    {
        $lokasi = Vacancy::select('location')->distinct()->get(); // Ambil kolom 'lokasi' dan pastikan hanya yang unik

        return response()->json($lokasi);
    }

    public function filterLowongan(Request $request)
    {
        $query = Vacancy::query();

        if ($request->filled('mode_kerja')) {
            // $query->where('mode_kerja', 'like', '%' . $request->mode_kerja . '%');
            $query->where('time_type', 'like', '%' . $request->mode_kerja . '%');
        }

        if ($request->filled('lokasi')) {
            $query->where('location', 'like', '%' . $request->lokasi . '%');
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('jurusan')) {
            $query->whereHas('major', function ($q) use ($request) {
                $q->where('id', $request->jurusan);
            });
        }

        if ($request->filled('prodi')) {
            $query->whereHas('study_program', function ($q) use ($request) {
                $q->where('lowongan_prodi.prodi_id', $request->prodi); // Gunakan nama tabel pivot secara eksplisit
            });
        }

        $lowongan = $query->with('major', 'studyPrograms')->get();

        return response()->json($query->get());
    }

    /**
     * Method untuk me-render halaman dashboard mahasiswa, perusahaan dan admin
     */
    public function index($id = 0)
    {
        $lowongan = Vacancy::with('company.profile', 'major')->get();

        return response()->view('dashboard', [
            'role' => 'admin',
            'lowongan' => $lowongan
        ]);

        $role = $this->roles[auth('web')->user()->role - 1];
        $user = auth('web')->user()->load('company.profile');
        $value = $this->handleCustomHeader($id, $role, $user);

        if ($value['success'] === true) {
            return response()->json($value);
        }

        $fullName = "{$user->$role->profile->first_name} {$user->$role->profile->last_name}";

        // jika fullname kosong, isi dengan data username
        if (trim($fullName) === '') {
            $fullName = 'Username';
        }

        $lowongan = Vacancy::with('company.profile', 'major')->get();

        return response()->view('dashboard', [
            'role' => $role,
            'lowongan' => $lowongan,
            'user' => auth('web')->user(),
            'fullName' => $fullName
        ]);
    }

    private function handleCustomHeader(int $id)
    {
        $args = func_get_args();

        if (request()->hasHeader('x-get-data')) {
            $value = request()->header('x-get-data');

            if ($value === 'specific-data') {
                $vacancy = Vacancy::with('company.profile', 'major')
                    ->where('nib', $args[2]->company->nib)
                    ->where('id_vacancy', $id)
                    ->first();

                return [
                    'vacancy' => $vacancy,
                    'role' => $args[1],
                    'success' => true
                ];
            }
        }

        return ['success' => false];
    }

    /**
     * Method untuk me-render halaman daftar lamaran mahasiswa
     */
    public function studentProposalListPage()
    {
        return response()->view('student.daftar-lamaran', [
            'role' => 'student'
        ]);
    }

    /**
     * Mehod untuk me-render halaman profile mahasiswa
     */
    public function studentProfilePage()
    {
        return response()->view('student.profile', [
            'role' => 'student'
        ]);
    }

    /**
     * Method untuk me-render halaman kelola lowongan perusahaan
     */
    public function companyManageVacancyPage($id = 0)
    {
        $role = $this->roles[auth('web')->user()->role - 1];
        $user = auth('web')->user()->load("$role.profile");
        $fullName = "{$user->$role->profile->first_name} {$user->$role->profile->last_name}";

        if (request()->hasHeader('x-get-data')) {
            $vacancies = Vacancy::with('company.profile')->where('nib', $user->company->nib)
                ->get();

            return response()->json(['data' => $vacancies]);
        }

        if (request()->hasHeader('x-get-specific')) {
            $vacancy = Vacancy::with('company.profile')->where('id_vacancy', $id)
                ->where('nib', $user->company->nib)
                ->first();

            return response()->json(['data' => $vacancy]);
        }


        if (trim($fullName) === "") {
            $fullName = "Username";
        }

        $lowongan = Vacancy::with('company.profile', 'major')->get();

        return response()->view('company.kelola-lowongan', [
            'role' => $role,
            'user' => $user,
            'fullName' => $fullName,
            'lowongan' => $lowongan
        ]);
    }

    /**
     * Method untuk me-render halaman daftar pelamar lowongan perusahaan
     */
    public function companyApplicantPage()
    {
        return response()->view('company.daftar-pelamar', [
            'role' => 'company'
        ]);
    }

    /**
     * Method untuk me-render halaman profile perusahaan
     */
    public function companyProfilePage()
    {


        return response()->view('company.profile', [
            'role' => 'company'
        ]);
    }

    /**
     * Method untuk me-render halaman kelola lowongan admin
     */
    public function adminManageVacancyPage()
    {
        return response()->view('admin.kelola-lowongan', [
            'role' => 'admin'
        ]);
    }

    /**
     * Method untuk me-render halaman kelola akun mahasiswa
     */
    public function adminManageUserStudent()
    {
        return response()->view('admin.kelola-mahasiswa', [
            'role' => 'admin'
        ]);
    }

    // menampilkan halaman mahasiswa tertentu
    public function adminViewUserStudent(int $id)
    {
        return view('admin.view-mahasiswa', [
            'role' => 'admin',
            'id_vacancy' => $id
        ]);
    }

    // menampilkan halaman profile admin
    public function adminProfilePage()
    {
        return response()->view('admin.profile', [
            'role' => 'admin'
        ]);
    }

    /**
     * Method untuk me-render halaman kelola akun perusahaan
     */
    public function adminManageUserCompany()
    {
        return response()->view('admin.kelola-perusahaan', [
            'role' => 'admin'
        ]);
    }

    // menampilkan halaman perusahaan tertentu
    public function adminViewUserCompany(int $id)
    {
        return view('admin.view-perusahaan', [
            'role' => 'admin',
            'id_vacancy' => $id
        ]);
    }

    // Method untuk menampilkan halaman notifikasi email verifikasi sudah terkirim
    public function verifyRegisteredEmailPage()
    {
        return response()->view('auth.verify-email');
    }

    // Method untuk melakukan verifikasi email user
    public function verifyRegisteredEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('signin');
    }
}
