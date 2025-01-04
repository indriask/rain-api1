<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\Prodi;
use App\Models\Profile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\StudyProgram;
use App\Models\Proposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

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

    public function filterVacancies(Request $request)
    {
        $query = DB::table('vacancy')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->select('vacancy.*', 'major.name as major_name');

        if ($request->has('jurusan') && $request->jurusan) {
            $query->where('major.id', $request->jurusan);
        }

        if ($request->has('lowongan') && $request->lowongan) {
            $query->where('vacancy.id_vacancy', $request->lowongan);
        }

        if ($request->has('lokasi') && $request->lokasi) {
            $query->where('vacancy.location', $request->lokasi);
        }

        $vacancies = $query->get();

        return response()->json($vacancies);
    }

    public function filterVacanciesByMajor(Request $request)
    {
        $major = $request->input('major'); // Ambil parameter jurusan dari request

        $vacancies = DB::table('vacancy')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->select('vacancy.*', 'major.name as major_name')
            ->where('major.name', $major) // Filter berdasarkan jurusan
            ->get();

        return response()->json($vacancies); // Kembalikan data dalam format JSON
    }

    public function filterVacanciesByTitle(Request $request)
    {
        $title = $request->input('title'); // Ambil parameter title dari request

        $vacancies = DB::table('vacancy')
            ->select('vacancy.*', 'major.*', 'major.name as major_name', 'company.*', 'profile.*', 'vacancy.type as vacancy_type', 'vacancy.location as vacancy_location')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->leftJoin('company', 'vacancy.nib', '=', 'company.nib')
            ->leftJoin('profile', 'company.id_profile', '=', 'profile.id_profile')
            ->where('vacancy.title', $title)
            ->get();

        return response()->json($vacancies); // Kembalikan data dalam format JSON
    }

    public function filterVacanciesByLocation(Request $request)
    {
        $location = $request->input('location'); // Ambil parameter lokasi dari request

        $vacancies = DB::table('vacancy')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->select('vacancy.*', 'major.name as major_name')
            ->where('vacancy.location', $location) // Filter berdasarkan lokasi
            ->get();

        return response()->json($vacancies); // Kembalikan data dalam format JSON
    }

    public function clearFilters()
    {
        $vacancies = DB::table('vacancy')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->select('vacancy.*', 'major.name as major_name')
            ->get();

        return response()->json($vacancies); // Kembalikan semua data dalam format JSON
    }

    /**
     * Method untuk me-render halaman dashboard mahasiswa, perusahaan dan admin
     */
    public function index($id = 0)
    {
        // dd(auth('web')->user()->id_user);s
        $role = $this->roles[auth('web')->user()->role - 1];
        $user = auth('web')->user()->load("$role.profile");
        $fullName = $user->$role->profile->first_name . ' ' . $user->$role->profile->last_name;
        $value = $this->handleCustomHeader($id, $user, $role);


        if ($value['success'] === true) {
            return response()->json($value, 200);
        }

        // jika fullname kosong, isi dengan data username
        if (trim($fullName) === '') {
            $fullName = 'Username';
        }

        // $lowongan = Vacancy::with('company.profile')->get();
        $lowongan = DB::table('vacancy')
            ->select('vacancy.*', 'major.name as major_name', 'company.*', 'profile.*', 'vacancy.type as vacancy_type', 'vacancy.location as vacancy_location')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->leftJoin('company', 'vacancy.nib', '=', 'company.nib')
            ->leftJoin('profile', 'company.id_profile', '=', 'profile.id_profile')
            ->get();
        $major = Major::all();
        // dd($major);
        // dd($lowongan);

        return response()->view('dashboard', [
            'role' => $role,
            'vacancies' => $lowongan,
            'majors' => $major,
            'user' => $user,
            'fullName' => $fullName
        ]);
    }

    private function handleCustomHeader($id = 0, $user, $role)
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

            if ($value === 'get-company-profile') {
            }
        }

        return ['success' => false];
    }

    /**
     * Method untuk mahasiswa
     */
    public function apply(Request $request)
    {
        // Validate the form input
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:10240', // Validate resume file
            'id_vacancy' => 'required|exists:vacancy,id_vacancy',
        ]);

        $isProposed = Proposal::where('id_vacancy', $request->id_vacancy)
            ->where('nim', auth('web')->user()->student->nim)
            ->first();

        if ($isProposed == true) {
            return back()->withErrors(['error' => 'Anda sudah melamar lowongan ini']);
        }

        $proposal = Vacancy::select('date_created', 'date_ended', 'quota', 'applied')
            ->where('id_vacancy', $request->id_vacancy)
            ->first();

        if (time() < strtotime($proposal->date_created)) {
            return back()->withErrors(['error' => 'Lowongan yang anda lamara belum dibuka']);
        }

        if (time() > strtotime($proposal->date_ended)) {
            return back()->withErrors(['error' => 'Lowongan yang anda lamar sudah tutup']);
        }

        if ($proposal->applied >= $proposal->quota) {
            return back()->withErrors(['error' => 'Lowongan yang anda lamar sudah penuh']);
        }

        // Save the resume file
        $file = $request->file('resume');
        $extension = $file->getClientOriginalExtension();  // Get the file extension (e.g., 'pdf', 'docx')

        // Get the current user's first name
        $firstName = auth('web')->user()->student->profile->first_name;

        // Get the current timestamp
        $timestamp = now()->timestamp;

        // Combine the first name and timestamp to create the filename
        $fileName = strtolower($firstName) . '_' . $timestamp . '.' . $extension;

        $filePath = $file->storeAs('resume/' . uniqid(), $fileName, 'local');

        $revertedFilePath = strrev($filePath);
        $explode = explode('/', $revertedFilePath, 2);
        $newFilePath = strrev($explode[1]);

        // Store the application data in the database
        Proposal::create([
            'id_vacancy' => $request->id_vacancy,
            'nim' => auth('web')->user()->student->nim, // Assuming the user is authenticated
            'resume' => $newFilePath,
            'applied_date' => now(),
            'final_status' => 'waiting', // default status
            'proposal_status' => 'waiting',
            'interview_status' => 'waiting',
        ]);

        $vacancy = Vacancy::where('id_vacancy', $request->id_vacancy)->first();
        $vacancy->applied += 1;
        $vacancy->save();

        return back()->with(['success' => 'Silahkan mengunggu konfirmasi dari lowongan']);
    }

    public function studentProposalListPage()
    {
        $role = $this->roles[auth('web')->user()->role - 1];
        $user = auth('web')->user()->load("$role.profile");
        $fullName = $user->$role->profile->first_name . ' ' . $user->$role->profile->last_name;

        // jika fullname kosong, isi dengan data username
        if (trim($fullName) === '') {
            $fullName = 'Username';
        }

        // Left join antara tabel vacancy dan major
        $vacancy = DB::table('vacancy')
            ->select('vacancy.*', 'major.name as major_name', 'company.*', 'profile.*', 'vacancy.type as vacancy_type', 'vacancy.location as vacancy_location', 'proposal.*')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->leftJoin('company', 'vacancy.nib', '=', 'company.nib')
            ->leftJoin('profile', 'company.id_profile', '=', 'profile.id_profile')
            ->leftJoin('proposal', 'proposal.id_vacancy', '=', 'vacancy.id_vacancy')
            ->where('proposal.nim', auth('web')->user()->student->nim)
            ->get();

        $major = Major::all();

        return response()->view('student.daftar-lamaran', [
            'vacancies' => $vacancy,
            'majors' => $major,
            'role' => $role,
            'user' => $user,
            'fullName' => $fullName
        ]);
    }

    public function getStudentProposalList($id, Request $request)
    {
        $header = $request->header('get-data', null);
        if (is_null($header) && $header !== 'student-proposal') {
            $response = $this->setResponse(
                success: false,
                title: 'Request expire',
                message: 'Terjadi kesalhaan saat melakukan request, harap coba lagi',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response()->json($response, 500);
        }

        $validator = Validator::make(['id_proposal' => $id], ['id_proposal' => ['required', 'integer', 'present']]);
        if ($validator->fails()) {
            $response = $this->setResponse(
                success: false,
                message: 'Data tidak ditemukan',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response()->json($response);
        }

        try {
            $proposal = Proposal::with('vacancy.company.profile', 'vacancy.major')
                ->where('id_proposal', $validator->getValue('id_proposal'))
                ->where('nim', auth('web')->user()->student->nim)
                ->firstOrFail();

            return response()->json($proposal);
        } catch (\Throwable $e) {
            $response = $this->setResponse(
                success: false,
                title: 'Request error',
                message: 'Terjadi kesalahaan saat melakukan request, harap coba lagi',
                icon: asset('storage/svg/failed-x.svg')
            );

            // return response()->json($response, 500);
            return response()->json($e->getMessage(), 500);
        }
    }

    public function getVacancyDetail($id)
    {
        // Fetch the vacancy data along with related company and major data
        $vacancy = Vacancy::with('company', 'major')->find($id);

        // Check if vacancy exists
        if (!$vacancy) {
            return response()->json(['error' => 'Vacancy not found'], 404);
        }

        // Check if the currently logged-in user has already applied for this vacancy
        $userHasApplied = $vacancy->proposals()->where('nim', auth()->user()->student->nim)->exists();
        $proposal = $vacancy->proposals()->where('nim', auth()->user()->student->nim)->first();
        // Return the vacancy details along with application status
        return response()->json([
            'title' => $vacancy->title,
            'salary' => $vacancy->salary,
            'major' => $vacancy->major->name,
            'location' => $vacancy->location,
            'type' => $vacancy->type,
            'time_type' => $vacancy->time_type,
            'duration' => $vacancy->duration,
            'quota' => $vacancy->quota,
            'applied' => $vacancy->proposals->count(),
            'date_created' => Carbon::parse($vacancy->date_created)->format('d F Y'),
            'date_ended' => Carbon::parse($vacancy->date_ended)->format('d F Y'),
            'description' => $vacancy->description,
            'company' => [
                'name' => $vacancy->company->profile->first_name . ' ' . $vacancy->company->profile->last_name,
                'photo' => $vacancy->company->profile->photo_profile
            ],
            'userHasApplied' => $userHasApplied,  // Return if the user has applied
            'proposal_status' => $proposal->proposal_status ?? "",
            'interview_status' => $proposal->interview_status ?? "",
            'final_status' => $proposal->final_status ?? "",
        ]);
    }

    public function getStudyProgramsByMajor($majorId)
    {
        // Fetch study programs based on the selected major
        $studyPrograms = StudyProgram::where('id_major', $majorId)->get();

        // Return the study programs as JSON
        return response()->json($studyPrograms);
    }

    public function studentProfilePage()
    {
        $user = Auth::user(); // Mendapatkan data user yang sedang login
        $student = $user->student; // Mengambil relasi student
        $profile = $student->profile; // Mengambil relasi profile
        $major = Major::all();
        $study_program = StudyProgram::all();

        $role = $this->roles[auth('web')->user()->role - 1];
        $fullName = $user->$role->profile->first_name . ' ' . $user->$role->profile->last_name;

        // jika fullname kosong, isi dengan data username
        if (trim($fullName) === '') {
            $fullName = 'Username';
        }

        return response()->view('student.profile', [
            'role' => $role,
            'student' => $student,
            'user' => $user,
            'profile' => $profile,
            'major' => $major,
            'study_program' => $study_program,
            'fullName' => $fullName
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'institute' => 'required|string|max:255',
            'skill' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'phone_number' => 'nullable|string|max:15',
            'description' => 'nullable|string',
            'major' => 'required',
            'old-photo-profile' => 'required|string',
        ]);

        $user = Auth::user();
        $student = $user->student;
        // dd($student);
        $profile = $student->profile;
        $oldProfile = $request->input('old-photo-profile');
        $hasFile = $request->has('photo-profile');

        if ($hasFile) {
            $file = $request->file('photo-profile');

            if ($file->getSize() > 2000000) {
                dd('file harus kurang dari 2mb');
            }

            $newFileName = time() . '_' . $file->getClientOriginalName();
        }

        // Update profile data
        $profile->update([
            'photo_profile' => ($hasFile) ? $file->storeAs('profile', $newFileName, 'public') : $oldProfile,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'location' => $request->location,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
            'description' => $request->description,
        ]);

        // Update student data
        $student->update([
            'institute' => $request->institute,
            'skill' => $request->skill,
            'id_major' => $request->major,
            'id_study_program' => $request->study_program
        ]);

        // return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
        return redirect()->back()->with('profile_updated', true);
    }

    /**
     * Method untuk perusahaan
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

    public function companyDownloadProposal($id = 0)
    {
        $data = Proposal::select(['nim', 'resume'])->where('id_proposal', $id)->first();
        $files = Storage::disk('local')->files($data['resume']);

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

    public function companyProfilePage()
    {
        $role = $this->roles[auth('web')->user()->role - 1];    // mengambil nama role berdasarkan id role
        $user = auth('web')->user()->load("$role.profile");
        // $response = $this->handleCustomHeader(user: $user, role: $role);


        $fullName = "{$user->$role->profile->first_name} {$user->$role->profile->last_name}";
        $fullName = trim($fullName) === "" ? "Username" : $fullName;

        return response()->view('company.profile', [
            'role' => $role,
            'fullName' => $fullName,
            'user' => $user,
            'profile' => $user->$role->profile
        ]);
    }

    /**
     * Method untuk admin
     */
    public function adminManageVacancyPage()
    {
        return response()->view('admin.kelola-lowongan', [
            'role' => 'admin'
        ]);
    }

    public function adminManageUserStudent()
    {
        $role = $this->roles[auth('web')->user()->role - 1];
        $user = auth('web')->user()->load("$role.profile");
        // $value = $this->handleCustomHeader($id, $user, $role);

        // if ($value['success'] === true) {
        //     return response()->json($value);
        // }

        $fullName = "{$user->$role->profile->first_name} {$user->$role->profile->last_name}";
        $fullName = trim($fullName) === "" ? "Username" : $fullName;
        $students = User::with('student.profile')->where('role', 1)->get();

        return response()->view('admin.kelola-mahasiswa', [
            'role' => $role,
            'students' => $students,
            'user' => $user,
            'fullName' => $fullName
        ]);
    }

    public function adminViewUserStudent(int $id)
    {
        $role = $this->roles[auth('web')->user()->role - 1];
        $user = auth('web')->user()->load("$role.profile");
        // $value = $this->handleCustomHeader($id, $user, $role);

        // if ($value['success'] === true) {
        //     return response()->json($value);
        // }

        $fullName = "{$user->$role->profile->first_name} {$user->$role->profile->last_name}";
        $fullName = trim($fullName) === "" ? "Username" : $fullName;
        $student = Student::with('profile', 'major', 'study_program', 'account')
            ->where('id_user', $id)
            ->firstOrFail();

        return view('admin.view-mahasiswa', [
            'role' => $role,
            'student' => $student,
            'user' => $user,
            'fullName' => $fullName
        ]);
    }

    public function adminManageUserCompany()
    {
        $role = $this->roles[auth('web')->user()->role - 1];
        $user = auth('web')->user()->load("$role.profile");
        // $value = $this->handleCustomHeader($id, $user, $role);

        // if ($value['success'] === true) {
        //     return response()->json($value);
        // }

        $fullName = "{$user->$role->profile->first_name} {$user->$role->profile->last_name}";
        $fullName = trim($fullName) === "" ? "Username" : $fullName;
        $companies = User::with('company.profile')->where('role', 2)->get();

        return response()->view('admin.kelola-perusahaan', [
            'role' => $role,
            'companies' => $companies,
            'user' => $user,
            'fullName' => $fullName
        ]);
    }

    public function adminViewUserCompany(int $id)
    {
        $role = $this->roles[auth('web')->user()->role - 1];
        $user = auth('web')->user()->load("$role.profile");
        // $value = $this->handleCustomHeader($id, $user, $role);

        // if ($value['success'] === true) {
        //     return response()->json($value);
        // }

        $fullName = "{$user->$role->profile->first_name} {$user->$role->profile->last_name}";
        $fullName = trim($fullName) === "" ? "Username" : $fullName;
        $company = Company::with('profile', 'account')
            ->where('id_user', $id)
            ->firstOrFail();

        return view('admin.view-perusahaan', [
            'role' => $role,
            'company' => $company,
            'user' => $user,
            'fullName' => $fullName
        ]);
    }

    public function adminDownloadCooperationFile($id = 0)
    {
        $data = Company::select(['cooperation_file', 'nib'])->where('id_user', $id)->firstOrFail();
        $filePath = storage_path('app/' . $data['cooperation_file']);
        $fileName = basename($data['cooperation_file']);

        if (!Storage::fileExists('cooperation_folder/' . $fileName)) {
            $response = $this->setResponse(
                success: false,
                title: 'File tidak ditemukan',
                message: 'File yang ingin di download tidak ada',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response()->json($response);
        }

        $zipName = $data['nib'] . '.zip';
        $zipPath = storage_path($zipName);
        $zip = new \ZipArchive();

        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            $zip->addFile($filePath, $fileName);
            $zip->close();
        } else {
            $response = $this->setResponse(
                success: false,
                title: 'Gagal membuat zip',
                message: 'Terjadi kesalahaan saat membuat zip',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response()->json($response);
        }

        $response = $this->setResponse(success: true);
        $response['url'] = url('/download-cooperation-file/' . $zipName);
        return response()->json($response);
    }

    public function adminProfilePage()
    {
        $role = $this->roles[auth('web')->user()->role - 1];    // mengambil nama role berdasarkan id role
        $user = auth('web')->user()->load("$role.profile");
        // $response = $this->handleCustomHeader(user: $user, role: $role);

        $fullName = "{$user->$role->profile->first_name} {$user->$role->profile->last_name}";
        $fullName = trim($fullName) === "" ? "Username" : $fullName;

        return response()->view('admin.profile', [
            'role' => $role,
            'fullName' => $fullName,
            'user' => $user,
            'profile' => $user->$role->profile
        ]);
    }

    /**
     * Method verifikasi email
     */
    public function verifyRegisteredEmailPage()
    {
        return response()->view('auth.verify-email');
    }

    public function verifyRegisteredEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('signin');
    }

    /**
     * Method untukd download file
     */
    public function downloadCooperationFile($filename)
    {
        $filePath = storage_path($filename);
        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath)->deleteFileAfterSend(true);
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
     * Method untuk set response ajax
     */
    private function setResponse(
        bool $success = true,
        string $title = '',
        string $message = '',
        string $type = '',
        string $icon = ''
    ): array {
        return [
            'success' => $success,
            'notification' => [
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'icon' => $icon
            ]
        ];
    }

    /**
     * Method untuk hapus akun
     */
    public function destroy(Request $request)
    {
        try {
            $user = Auth::user();

            // Hapus data terkait user jika diperlukan
            $user->delete(); // Hapus akun pengguna

            // Logout setelah akun dihapus
            Auth::logout();

            return response()->json(['message' => 'Akun berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus akun.'], 500);
        }
    }
}
