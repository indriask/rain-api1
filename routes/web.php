<?php

use App\Http\Controllers\api\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// Routing ke halaman branding RAIN
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::redirect('/index', '/', 302);






// akun user tidak perlu ter-authentikasi dan email terverifikasi kalau mau masuk
// route dibawah ini
Route::middleware('guest')->group(function () {
    Route::get('/signin', [IndexController::class, 'signinPage'])->name('login');
    Route::get('/signin', [IndexController::class, 'signinPage'])->name('signin');
    Route::get('/admin/signin', [IndexController::class, 'signinAdminPage'])->name('admin-singin');
    Route::get('/mahasiswa/signup', [IndexController::class, 'signupStudentPage'])->name('student-signup');
    Route::get('/perusahaan/signup', [IndexController::class, 'signupCompanyPage'])->name('company-signup');
});


// akun user harus ter-authtntikasi dan email sudah diverifikasi kalau mau masuk ke route dibawah ini
Route::middleware(['auth', 'verified'])->group(function () {
    // Routing ke halaman dashboard mahasiswa, perusahaan dan admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/lowongan', [DashboardController::class, 'getVacancy'])->name('dashboard-get-lowongan');

    // Routing khusus role mahasiswa
    Route::get('/dashboard/mahasiswa/list/lamaran', [DashboardController::class, 'studentProposalListPage'])->name('student-proposal-list');
    Route::get('/dashboard/mahasiswa/profile', [DashboardController::class, 'studentProfilePage'])->name('student-profile');

    // Routing khusus role perusahaan
    Route::get('/dashboard/perusahaan/daftar/pelamar', [DashboardController::class, 'companyApplicantPage'])->name('company-applicant-list');
    Route::get('/dashboard/perusahaan/kelola/lowongan/{id?}', [DashboardController::class, 'companyManageVacancyPage'])->name('company-manage-vacancy');
    Route::get('/dashboard/perusahaan/profile', [DashboardController::class, 'companyProfilePage'])->name('company-profile');

    // Routing khusus role admin
    Route::get('/dashboard/admin/profile', [DashboardController::class, 'adminProfilePage'])->name('admin-profile');
    Route::get('/dashboard/admin/kelola/user/mahasiswa', [DashboardController::class, 'adminManageUserStudent'])->name('admin-manage-user-student');
    Route::get('/dashboad/admin/kelola/user/perusahaan', [DashboardController::class, 'adminManageUserPerusahaan'])->name('admin-manage-user-company');
});






Route::get('/lowongan', [DashboardController::class, 'getLowongan']);
Route::get('/lowongan/filter', [DashboardController::class, 'filterLowongan']);
Route::get('/jurusan', [DashboardController::class, 'getJurusan']);
Route::get('/prodi', [DashboardController::class, 'getProdi']);
Route::get('/lokasi', [DashboardController::class, 'getLokasi']);







// akun user harus ter-autentikasi sebelum masuk ke route dibawah ini
Route::middleware('auth')->group(function () {
    // Routing untuk halaman verifikasi email yang di daftarkan
    Route::get('/email/verify', [DashboardController::class, 'verifyRegisteredEmailPage'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [DashboardController::class, 'verifyRegisteredEmail'])
        ->middleware('signed')
        ->name('verification.verify');
});







// Routing untuk system forgot password
Route::get('/forgot-password', [ResetPasswordController::class, 'passwordRequest'])->name('password.request');
Route::get('/forgot-password/{token}', [ResetPasswordController::class, 'passwordReset'])->name('password.reset');






// Route untuk testing session
Route::get('/test', function (Request $request) {
    dd($request->session()->all());
});

Route::get('/clear-session', function (Request $request) {
    $request->session()->flush();
});
