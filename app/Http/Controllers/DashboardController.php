<?php

namespace App\Http\Controllers;

use App\Mail\ApplyVacancy;
use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\Profile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\StudyProgram;
use App\Models\Proposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
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
            ->select('vacancy.*', 'major.*', 'major.name as major_name', 'company.*', 'profile.*', 'vacancy.type as vacancy_type', 'vacancy.location as vacancy_location')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->leftJoin('company', 'vacancy.nib', '=', 'company.nib')
            ->leftJoin('profile', 'company.id_profile', '=', 'profile.id_profile')
            ->where('major.name', $major)
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
            ->select('vacancy.*', 'major.*', 'major.name as major_name', 'company.*', 'profile.*', 'vacancy.type as vacancy_type', 'vacancy.location as vacancy_location')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->leftJoin('company', 'vacancy.nib', '=', 'company.nib')
            ->leftJoin('profile', 'company.id_profile', '=', 'profile.id_profile')
            ->where('vacancy.location', $location)
            ->get();

        return response()->json($vacancies); // Kembalikan data dalam format JSON
    }

    public function clearFilters()
    {
        $vacancies = DB::table('vacancy')
            ->select('vacancy.*', 'major.*', 'major.name as major_name', 'company.*', 'profile.*', 'vacancy.type as vacancy_type', 'vacancy.location as vacancy_location')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->leftJoin('company', 'vacancy.nib', '=', 'company.nib')
            ->leftJoin('profile', 'company.id_profile', '=', 'profile.id_profile')
            ->get();

        return response()->json($vacancies); // Kembalikan semua data dalam format JSON
    }

    // bagian method untuk render halaman dashboard
    public function index()
    {
        $role = $this->roles[auth('web')->user()->role - 1];
        $user = auth('web')->user()->load("$role.profile");
        $fullName = $user->$role->profile->first_name . ' ' . $user->$role->profile->last_name;
        $fullName = trim($fullName) === '' ? 'Username' : $fullName;

        $lowongan = DB::table('vacancy')
            ->select('vacancy.*', 'major.name as major_name', 'company.*', 'profile.*', 'vacancy.type as vacancy_type', 'vacancy.location as vacancy_location')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->leftJoin('company', 'vacancy.nib', '=', 'company.nib')
            ->leftJoin('profile', 'company.id_profile', '=', 'profile.id_profile')
            ->get();
        $major = Major::all();

        return response()->view('dashboard', [
            'role' => $role,
            'vacancies' => $lowongan,
            'majors' => $major,
            'user' => $user,
            'fullName' => $fullName
        ]);
    }

    public function getVacancyDetail($id)
    {
        $role = $this->roles[auth('web')->user()->role - 1];
        $vacancy = Vacancy::with('company.profile', 'major')
            ->where('id_vacancy', $id)
            ->first();

        if (empty($vacancy)) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Data tidak ditemukan',
                message: 'Data yang anda cari tidak ada',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }

        return response()->json($this->setResponse(
            success: true,
            additional: ['vacancy' => $vacancy, 'role' => $role]
        ), 200);
    }

    // bagian method untuk logika dashboard mahasiswa
    public function apply(Request $request)
    {
        $validator = Validator::make($request->only('resumes', 'id_vacancy'), [
            'resumes' => 'required',
            'id_vacancy' => 'required|exists:vacancy,id_vacancy',
        ]);

        if ($validator->fails()) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Request ditolak',
                message: 'Data yang anda input tidak valid, harap coba lagi',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }

        if (count($request->file('resumes')) > 6) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Request ditolak',
                message: 'Maksimum file upload adalah 6',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }

        $isProposed = Proposal::where('id_vacancy', $request->id_vacancy)
            ->where('nim', auth('web')->user()->student->nim)
            ->first();

        if ($isProposed == true) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Request ditolak',
                message: 'Anda sudah melamar lowongan ini',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }

        $vacancy = Vacancy::with('company.profile')
            ->with('company.account')
            ->select('date_created', 'date_ended', 'quota', 'applied', 'nib', 'title')
            ->where('id_vacancy', $request->id_vacancy)
            ->first();

        if (time() < strtotime($vacancy->date_created)) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Request ditolak',
                message: 'Lowongan yang anda lamar belum dibuka',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }

        if (time() > strtotime($vacancy->date_ended)) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Request ditolak',
                message: 'Lowongan yang anda lamar sudah di tutup',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }

        if ($vacancy->applied >= $vacancy->quota) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Request ditolak',
                message: 'Lowongan yang anda lamar sudah penuh',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }

        try {
            $files = $request->file('resumes');
            $dirPath = 'resume/' . uniqid();

            foreach ($files as $file) {
                $fileName = $file->getClientOriginalName();

                if (!in_array(strtolower($file->getClientOriginalExtension()), ['pdf', 'docx']) || $file->getSize() > 2000000) {
                    continue;
                }

                $file->storeAs($dirPath, $fileName, 'local');
            }

            // Store the application data in the database
            Proposal::create([
                'id_vacancy' => $request->id_vacancy,
                'nim' => auth('web')->user()->student->nim, // Assuming the user is authenticated
                'resume' => $dirPath,
                'applied_date' => now(),
                'final_status' => 'waiting', // default status
                'proposal_status' => 'waiting',
                'interview_status' => 'waiting',
            ]);

            $company = $vacancy->company->profile;
            $companyFullName = ($company->first_name ?? 'Username') . ' ' . $company->last_name ?? '';
            $applicant = auth('web')->user()->load('student.profile');

            $mail = (new ApplyVacancy($companyFullName, $applicant, $vacancy))
                ->onConnection('database')
                ->onQueue('default');

            Mail::to($vacancy->company->account)->queue($mail);

            return response()->json($this->setResponse(
                success: true,
                title: 'Lamaran diunggah',
                message: 'Lamaran anda telah diunggah, silahkan menunggu konfirmasi selanjutnya',
                icon: asset('storge/svg/success-checkmark.svg')
            ), 200);
        } catch (\Throwable $e) {
            // return response()->json($this->setResponse(
            //     success: true,
            //     title: 'Lamaran diunggah',
            //     message: 'Lamaran anda telah diunggah, silahkan menunggu konfirmasi selanjutnya',
            //     icon: asset('storge/svg/failed-x.svg')
            // ), 500);

            return response()->json($e->getMessage(), 500);
        }
    }

    public function studentProposalListPage()
    {
        $role = $this->roles[auth('web')->user()->role - 1];
        $user = auth('web')->user()->load("$role.profile");
        $fullName = $user->$role->profile->first_name . ' ' . $user->$role->profile->last_name;
        $fullName = trim($fullName) === '' ? 'Username' : $fullName;

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

    public function getProposalDetail($id)
    {
        $validator = Validator::make(['id_proposal' => $id], ['id_proposal' => ['required', 'integer', 'present']]);
        if ($validator->fails()) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Data tidak ditemukan',
                message: 'Data yang anda cari tidak ditemukan',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }

        try {
            $proposal = Proposal::with('vacancy.company.profile', 'vacancy.major')
                ->where('id_proposal', $validator->getValue('id_proposal'))
                ->where('nim', auth('web')->user()->student->nim)
                ->firstOrFail();

            return response()->json($proposal, 200);
        } catch (\Throwable $e) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Request error',
                message: 'Terjadi kesalhaan saat melakukan request, harap coba lagi',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }
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

    public function getStudentProfileData()
    {
        return response()->json(auth('web')->user()->load('student.profile', 'student.major', 'student.study_program'));
    }

    // bagian method untuk logika dashboard perusahaan
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

    // bagian method unutk logika dashboard admin
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

    // bagian method untuk verifikasi email
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

    // untuk set response ajax
    private function setResponse(
        bool $success = true,
        string $title = '',
        string $message = '',
        string $type = '',
        string $icon = '',
        array $additional = []
    ): array {
        $response = [
            'success' => $success,
            'notification' => [
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'icon' => $icon
            ]
        ];

        if ($additional !== []) {
            $response['additional'] = $additional;
        }

        return $response;
    }

    private function handleCustomHeader($id = 0, $user, $role)
    {
        if (request()->hasHeader('x-get-data')) {
            $value = request()->header('x-get-data');

            if ($value === 'specific-data') {
                $vacancy = Vacancy::with('company.profile', 'major')
                    ->where('id_vacancy', $id)
                    ->first();

                if (empty($vacancy)) {
                    $response = $this->setResponse(
                        success: true,
                        title: 'Data tidak ditemukan',
                        message: 'Data yang anda pilih tidak ada',
                        icon: asset('storage/svg/failed-x.svg')
                    );
                    $response['code'] = 500;

                    return $response;
                }

                return [
                    'vacancy' => $vacancy,
                    'role' => $role,
                    'success' => true,
                    'code' => 200
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
}
