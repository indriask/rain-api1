<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\StudyProgram;
use App\Models\Proposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $user = auth('web')->user();
        $fullName = $user->$role->profile->first_name . ' ' . $user->$role->profile->last_name;

        // jika fullname kosong, isi dengan data username
        if (trim($fullName) === '') {
            $fullName = 'Username';
        }

        // $lowongan = Vacancy::with('company.profile')->get();
        $lowongan = DB::table('vacancy')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->select('vacancy.*', 'major.name as major_name')
            ->get();
        $major = Major::all();
        // dd($major);

        return response()->view('dashboard', [
            'role' => $role,
            'vacancies' => $lowongan,
            'majors' => $major,
            'user' => auth('web')->user(),
            'fullName' => $fullName
        ]);
    }


    /**
     * Method untuk me-render halaman daftar lamaran mahasiswa
     */
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

    public function apply(Request $request)
    {
        // Validate the form input
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:10240', // Validate resume file
            'vacancy_id' => 'required|exists:vacancy,id_vacancy',
        ]);

        // Save the resume file
        $file = $request->file('resume');
        $extension = $file->getClientOriginalExtension();  // Get the file extension (e.g., 'pdf', 'docx')
        
        // Get the current user's first name
        $firstName = auth()->user()->student->profile->first_name;
        
        // Get the current timestamp
        $timestamp = now()->timestamp;
        
        // Combine the first name and timestamp to create the filename
        $fileName = strtolower($firstName) . '_' . $timestamp . '.' . $extension;
        
        $filePath = $file->storeAs('resumes', $fileName, 'public');
        

        // Store the application data in the database
        Proposal::create([
            'id_vacancy' => $request->vacancy_id,
            'nim' => auth()->user()->student->nim, // Assuming the user is authenticated
            'resume' => $filePath,
            'applied_date' => now(),
            'final_status' => 'waiting', // default status
            'proposal_status' => 'waiting',
            'interview_status' => 'waiting',
        ]);

        return response()->json(['success' => true]);
    }

    public function studentProposalListPage()
    {
        // Left join antara tabel vacancy dan major
        $vacancy = DB::table('vacancy')
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->select('vacancy.*', 'major.name as major_name')
            ->get();
        $major = Major::all();


        // dd($vacancy);

        return response()->view('student.daftar-lamaran', [
            'vacancies' => $vacancy,
            'majors' => $major,
            'role' => 'student'
        ]);
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
            ->leftJoin('major', 'vacancy.id_major', '=', 'major.id')
            ->select('vacancy.*', 'major.name as major_name')
            ->where('vacancy.title', $title) // Filter berdasarkan title
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
     * Mehod untuk me-render halaman profile mahasiswa
     */
    public function studentProfilePage()
    {
        $user = Auth::user(); // Mendapatkan data user yang sedang login
        $student = $user->student; // Mengambil relasi student
        $profile = $student->profile; // Mengambil relasi profile
        $major = Major::all();
        $study_program = StudyProgram::all();

        // dd($student);

        return response()->view('student.profile', [
            'role' => 'student',
            'student' => $student,
            'user' => $user,
            'profile' => $profile,
            'major' => $major,
            'study_program' => $study_program,
        ]);
    }

    // public function updateProfile(Request $request)
    // {
    //     $user = auth()->user(); // Mendapatkan data user yang login

    //     // Validasi data
    //     $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'location' => 'nullable|string|max:255',
    //         'postal_code' => 'nullable|string|max:10',
    //         'city' => 'nullable|string|max:255',
    //         'phone_number' => 'nullable|string|max:15',
    //         'description' => 'nullable|string',
    //         'institute' => 'nullable|string|max:255',
    //         'skill' => 'nullable|string|max:255',
    //     ]);

    //     // Update profile
    //     DB::table('profile')
    //         ->where('id_profile', $user->id_profile)
    //         ->update([
    //             'first_name' => $request->first_name,
    //             'last_name' => $request->last_name,
    //             'location' => $request->location,
    //             'postal_code' => $request->postal_code,
    //             'city' => $request->city,
    //             'phone_number' => $request->phone_number,
    //             'description' => $request->description,
    //         ]);

    //     // Update student data
    //     DB::table('student')
    //         ->where('id_user', $user->id_user)
    //         ->update([
    //             'institute' => $request->institute,
    //             'skill' => $request->skill,
    //         ]);

    //     return redirect()->route('student-profile')->with('success', 'Profil berhasil diperbarui.');
    // }


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
        ]);

        $user = Auth::user();
        $student = $user->student;
        // dd($student);
        $profile = $student->profile;

        // Update profile data
        $profile->update([
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

        return response()->view('company.kelola-lowongan', [
            'role' => $role,
            'user' => $user,
            'fullName' => $fullName
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
            'role' => 'student'
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
