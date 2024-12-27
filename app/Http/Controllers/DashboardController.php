<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\Profile;
use App\Models\Proposal;
use App\Models\StudyProgram;
use Illuminate\Support\Facades\Storage;

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
        $role = $this->roles[auth('web')->user()->role - 1];
        $user = auth('web')->user()->load("$role.profile");
        $value = $this->handleCustomHeader($id, $user, $role);

        if ($value['success'] === true) {
            return response()->json($value);
        }

        $fullName = "{$user->$role->profile->first_name} {$user->$role->profile->last_name}";
        $fullName = trim($fullName) === "" ? "Username" : $fullName;
        $lowongan = Vacancy::with('company.profile', 'major')->get();

        return response()->view('dashboard', [
            'role' => $role,
            'lowongan' => $lowongan,
            'user' => $user,
            'fullName' => $fullName
        ]);
    }

    private function handleCustomHeader(int $id, $user, $role)
    {
        if (request()->hasHeader('x-get-data')) {
            $value = request()->header('x-get-data');

            if ($value === 'specific-data') {
                $vacancy = Vacancy::with('company.profile', 'major')
                    ->where('id_vacancy', $id)
                    ->first();

                return [
                    'vacancy' => $vacancy,
                    'role' => $role,
                    'success' => true
                ];
            }

            if ($value === 'specific-data-company') {
                $vacancy = Vacancy::with('company.profile', 'major')
                    ->where('id_vacancy', $id)
                    ->where('nib', $user->$role->nib)
                    ->first();

                return [
                    'vacancy' => $vacancy,
                    'role' => $role,
                    'success' => true
                ];
            }

            if ($value === 'get-applicants') {
                $applicants = Proposal::select(['id_proposal', 'nim', 'id_vacancy', 'resume'])
                    ->with([
                        'student.profile' => function ($query) {
                            $query->select(['id_profile', 'photo_profile', 'first_name', 'last_name']);
                        },
                        'student.account' => function ($query) {
                            $query->select(['id_user', 'email']);
                        },
                        'vacancy' => function ($query) use ($user) {
                            $query->select(['title', 'id_vacancy']);
                        }
                    ])
                    ->whereHas('vacancy', function ($query) use ($user, $role) {
                        $query->where('nib', $user->$role->nib);
                    })
                    ->get();

                // ubah string file menjadi array
                foreach ($applicants as $applicant) {
                    $applicant->resume = Storage::allFiles($applicant->resume);
                }

                return [
                    'success' => true,
                    'applicants' => $applicants,
                ];
            }

            if ($value === 'get-applicant-profile') {
                $profile = Profile::with('student.account', 'student.major', 'student.study_program')
                    ->where('id_profile', $id)
                    ->first();

                return [
                    'success' => true,
                    'profile' => $profile
                ];
            }

            if ($value === 'get-applicant-proposal') {
                $proposal = Proposal::select('resume', 'nim')->with([
                    'student.profile' => function ($query) {
                        $query->select(['first_name', 'last_name', 'phone_number', 'id_profile']);
                    },
                    'student.account' => function ($query) {
                        $query->select(['email', 'id_user']);
                    },
                    'student.major' => function ($query) {
                        $query->select(['name', 'id']);
                    },
                    'student.study_program' => function ($query) {
                        $query->select(['name', 'id']);
                    }
                ])->where('id_proposal', $id)->first();

                return [
                    'success' => true,
                    'proposal' => $proposal
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
        $value = $this->handleCustomHeader($id, $user, $role);

        if ($value['success'] === true) {
            return $value;
        }

        $fullName = "{$user->$role->profile->first_name} {$user->$role->profile->last_name}";
        $fullName = trim($fullName) === "" ? "Username" : $fullName;
        $lowongan = Vacancy::with('company.profile', 'major')->where('nib', $user->company->nib)->get();

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
    public function companyApplicantPage($id = 0)
    {
        $role = $this->roles[auth('web')->user()->role - 1];
        $user = auth('web')->user()->load("$role.profile");
        $value = $this->handleCustomHeader($id, $user, $role);

        if ($value['success'] === true) {
            return response()->json($value);
        }

        $fullName = "{$user->$role->profile->first_name} {$user->$role->profile->last_name}";
        $fullName = trim($fullName) === "" ? "Username" : $fullName;

        return response()->view('company.daftar-pelamar', [
            'role' => $role,
            'user' => $user,
            'fullName' => $fullName
        ]);
    }

    // method untuk download file proposal pelamar
    public function companyDownloadProposal($id = 0)
    {
        $data = Proposal::select(['nim', 'resume'])->where('id_proposal', $id)->first();
        $files = Storage::files($data['resume']);

        if (empty($files)) {
            return response()->json(['file_error' => 'File tidak ada']);
        }

        $zipName = $data['nim'] . '.zip';
        $zipPath = storage_path($zipName);

        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($files as $file) {
                $filePath = storage_path("app/$file");
                $fileName = basename($file);
                $zip->addFile($filePath, $fileName);
            }
            $zip->close();
        } else {
            return response()->json(['file_error' => 'Terjadi kesalahan saat melakukan zip']);
        }

        return response()->json(['url' => url('/download-proposal/' . $zipName)]);
    }

    public function downloadProposal($filename)
    {
        $filePath = storage_path($filename);
        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath)->deleteFileAfterSend(true);
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
