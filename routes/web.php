<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/**
 * Penjelasan singkat mengenai beberapa controller
 * A
 * 1. AdminSigninController => digunakan untuk mem-proses data signin admin dan mengarahkan
 *                             user ke halaman signin perusahaan
 * 
 * C
 * 1. CompanyProfileController => digunakan untuk mem-proses data profile perusahaan
 * 2. CompanySignupController => digunakan untuk mem-proses data signup perusahaan dan mengarahkan 
 *                               user ke halaman signup perusahaan
 * 
 * D
 * 1. DashboardCompanyProfile => digunakan untuk mem-proses data dashboard perusahaan
 * 2. DashboardController => hanya digunakan untuk mengarahkan user ke halaman tertentu
 * 3. DashboardStudentController => digunakan untuk mem-proses data dashboard student
 * 4. DeleteAccountController => digunakan untuk mem-proses penghapusan akun mahasiswa dan perusahaan
 * 
 * F
 * 1. ForgetPasswordController => digunakan untuk mem-proses data forget password
 * 
 * L
 * 1. LogoutController => digunakan untuk mem-proses data logout mahasiswa, perusahaan dan admin
 * 
 * S
 * 1. StudentSignupController => digunakan untuk mem-proses data signup mahasiswa
 * 2. StudentProfileController => digunakan untuk mem-proses data profile mahasiswa
 * 3. SigninController => digunakan untuk mem-proses data signin mahasiswa dan perusahaan
 * 
 * W
 * 1. IndexController => hanya digunakan untuk mengarahkan user pada halaman branding RAIN
 */




// Routing ke halaman branding RAIN
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::redirect('/index', '/', 302);

// Routing ke halaman signin mahasiswa, perusahaan dan admin
Route::get('/signin', [IndexController::class, 'signinPage'])
    ->name('signin');

Route::get('/admin/signin', [IndexController::class, 'adminSigninPage'])
    ->name('admin-singin');

// Routing ke halaman dashboard mahasiswa, perusahaan dan admin
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'verified']);

// Routing khusus role mahasiswa
Route::get('/mahasiswa/signup', [IndexController::class, 'signupStudentPage'])->name('student-signup');
Route::get('/dashboard/mahasiswa/list/lamaran', [DashboardController::class, 'studentProposalListPage'])->name('student-proposal-list');
Route::get('/dashboard/mahasiswa/profile', [DashboardController::class, 'studentProfilePage'])->name('student-profile');

// Routing khusus role perusahaan
Route::get('/perusahaan/signup', [IndexController::class, 'signupCompanyPage'])->name('company-signup');
Route::get('/dashboard/perusahaan/kelola/lowongan', [DashboardController::class, 'companyManageVacancyPage'])->name('company-manage-vacancy');
Route::get('/dashboard/perusahaan/daftar/pelamar', [DashboardController::class, 'companyApplicantPage'])->name('company-applicant-list');
Route::get('/dashboard/perusahaan/profile', [DashboardController::class, 'companyProfilePage'])->name('company-profile');

// Routing khusus role admin
Route::get('/dashbord/admin/kelola/lowongan', [DashboardController::class, 'adminManageVacancyPage'])->name('admin-manage-vacancy');
Route::get('/dashboard/admin/kelola/user/mahasiswa', [DashboardController::class, 'adminManageUserStudent'])->name('admin-manage-user-student');
Route::get('/dashboad/admin/kelola/user/perusahaan', [DashboardController::class, 'adminManageUserPerusahaan'])->name('admin-manage-user-company');

// Routing untuk halaman verifikasi email yang di daftarkan
Route::get('/email/verify', [DashboardController::class, 'verifyRegisteredEmailPage'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [DashboardController::class, 'verifyRegisteredEmail'])->middleware(['auth', 'signed'])->name('verification.verify');

// Routing untuk system forgot password
Route::get('/forgot-password', [ResetPasswordController::class, 'passwordRequest'])
    ->middleware('guest')->name('password.request');

Route::get('/forgot-password/{token}', [ResetPasswordController::class, 'passwordReset'])
    ->middleware('guest')->name('password.reset');







// Route untuk testing session
Route::get('/test', function (Request $request) {
    dd($request->session()->all());
});

Route::get('/clear-session', function (Request $request) {
    $request->session()->flush();
});
