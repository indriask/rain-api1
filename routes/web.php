<?php

use App\Http\Controllers\AdminSigninController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CompanySignupController;
use App\Http\Controllers\DashboardCompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardStudentController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\StudentSignupController;
use App\Http\Controllers\WelcomeController;
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
 * 
 * F
 * 1. ForgetPasswordController => digunakan untuk mem-proses data forget password
 * 
 * S
 * 1. StudentSignupController => digunakan untuk mem-proses data signup mahasiswa
 * 2. StudentProfileController => digunakan untuk mem-proses data profile mahasiswa
 * 3. SigninController => digunakan untuk mem-proses data signin mahasiswa dan perusahaan
 * 
 * W
 * 1. WelcomeController => hanya digunakan untuk mengarahkan user pada halaman branding RAIN
 */







/**
 * Route ke halaman branding RAIN
 */
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::redirect('/index', '/', 302);

/**
 * Route ke halaman signin mahasiswa dan perusahaan
 */
Route::get('/signin', [SigninController::class, 'index'])->name('signin');
Route::post('/signin', [SigninController::class, 'validateCredentials'])->name('validate-credentials');

/**
 * Route ke halaman dashboard mahasiswa, perusahaan dan admin
 */
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/**
 * Route ke halaman forget password untuk mahasiswa dan perusahaan
 */
Route::get('/forget-password', [ForgetPasswordController::class, 'index'])->name('forget-password');
Route::post('/forget-password', [ForgetPasswordController::class, 'sendEmail'])->name('forget-password-post');
Route::post("/password/reset/{token}/{email}", [ForgetPasswordController::class, "updatePassword"])->name('password.reset.post');
Route::get("/password/reset/{token}/{email}", [ForgetPasswordController::class, "formResetPassword"])->name('password.reset');

/**
 * Routing khusus role mahasiswa
 */
Route::prefix('/dashboard/mahasiswa')->group(function () {
    Route::get('/signup', [StudentSignupController::class, 'index'])->name('student-signup');
    Route::post('/signup', [StudentSignupController::class, 'doSignup'])->name('do-student-signup');

    Route::get('/daftar/lamaran', [DashboardController::class, 'studentProposalListPage'])->name('student-proposal-list');
    Route::get('/daftar/lamaran/status/lamaran/{id}', [DashboardStudentController::class, 'getLamaranStatus'])->name('student-proposal-status');
    Route::get('/daftar/lamaran/status/wawancara/{id}', [DashboardStudentController::class, 'getWawancaraStatus'])->name('student-interview-status');
    Route::get('/profile', [DashboardController::class, 'studentProfilePage'])->name('student-profile');
});

/**
 * Routing khusus role perusahaan
 */
Route::prefix('/dashboard/perusahaan')->group(function () {
    Route::get('/signup', [CompanySignupController::class, 'index'])->name('company-signup');
    Route::post('/signup', [CompanySignupController::class, 'doSignup'])->name('do-signup-company');

    Route::get('/tambah/lowongan', [DashboardCompanyController::class, 'addVacancy'])->name('company-add-vacancy');
    Route::get('/kelola/lowongan', [DashboardController::class, 'companyManageVacancyPage'])->name('company-manage-vacancy');
    Route::get('/daftar/pelamar', [DashboardController::class, 'companyProposalListPage'])->name('company-proposal-list');
    Route::get('/profile', [DashboardController::class, 'companyProfilePage'])->name('company-profile');
});

/**
 * Routing khusus role admin
 */
Route::prefix('/dashboard/admin')->group(function () {
    Route::get('/signin', [AdminSigninController::class, 'index'])->name('admin-signin');
    Route::post('signin', [AdminSigninController::class, 'validateCredentials'])->name('admin-validate-credentials');

    Route::get('/kelola/lowongan', [DashboardController::class, 'adminManageVacancyPage'])->name('admin-manage-vacancy');
    Route::get('/kelola/user/mahasiswa', [DashboardController::class, 'adminManageUserStudent'])->name('admin-manage-student');
    Route::get('/kelola/user/perusahaan', [DashboardController::class, 'adminManageUserCompany'])->name('admin-manage-company');
});
