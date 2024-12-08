<?php

use App\Http\Controllers\AdminSigninController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CompanySignupController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardCompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardStudentController;
use App\Http\Controllers\DeleteAccountController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\LogoutController;
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
 * 1. WelcomeController => hanya digunakan untuk mengarahkan user pada halaman branding RAIN
 */







/**
 * Route ke halaman branding RAIN
 */
Route::get('/', [WelcomeController::class, 'welcome'])->name('home');
Route::redirect('/index', '/', 302);

/**
 * Route ke halaman signin mahasiswa dan perusahaan
 */
Route::get('/signin', [SigninController::class, 'index'])->name('signin');
Route::post('/signin', [SigninController::class, 'signin'])->name('validate-credentials');

/**
 * Route ke halaman dashboard mahasiswa, perusahaan dan admin
 */
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/logout', [LogoutController::class, 'logout'])->name('logout');

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

    Route::post('/daftar/lamaran', [DashboardStudentController::class, 'daftarLamaran'])->name('student-applied-proposal');

    Route::get('/list/lamaran', [DashboardController::class, 'studentProposalListPage'])->name('student-proposal-list');
    Route::get('/list/lamaran/status/lamaran/{id}', [DashboardStudentController::class, 'getProposalStatus'])->name('student-proposal-status');
    Route::get('/list/lamaran/status/wawancara/{id}', [DashboardStudentController::class, 'getInterviewStatus'])->name('student-interview-status');

    Route::get('/profile', [DashboardController::class, 'studentProfilePage'])->name('student-profile');
    Route::post('/profile/edit', [StudentProfileController::class, 'editProfile'])->name('student-edit-profile');
    Route::post('/profile/delete/account', [DeleteAccountController::class, 'deleteAccount'])->name('student-delete-account');
});

/**
 * Routing khusus role perusahaan
 */
Route::prefix('/dashboard/perusahaan')->group(function () {
    Route::get('/signup', [CompanySignupController::class, 'index'])->name('company-signup');
    Route::post('/signup', [CompanySignupController::class, 'doSignup'])->name('do-company-signup');

    Route::post('/tambah/lowongan', [DashboardCompanyController::class, 'addVacancy'])->name('company-add-vacancy');

    Route::get('/kelola/lowongan', [DashboardController::class, 'companyManageVacancyPage'])->name('company-manage-vacancy');
    Route::post('/kelola/lowongan/edit', [DashboardCompanyController::class, 'editVacancy'])->name('company-edit-vacancy');

    Route::get('/daftar/pelamar', [DashboardController::class, 'companyProposalListPage'])->name('company-proposal-list');
    Route::post('/daftar/pelamar/delete/applicant', [DashboardCompanyController::class, 'deleteApplicant'])->name('company-delete-applicant');
    Route::post('/daftar/pelamar/perbarui/status', [DashboardCompanyController::class, 'updateStatusApplicant'])->name('company-update-status-applicant');

    Route::get('/profile', [DashboardController::class, 'companyProfilePage'])->name('company-profile');
    Route::post('/profile/edit', [CompanyProfileController::class, 'editProfile'])->name('company-edit-profile');
    Route::post('/proifle/delete/account', [DeleteAccountController::class, 'deleteAccount'])->name('company-delete-account');
});

/**
 * Routing khusus role admin
 */
Route::prefix('/admin')->group(function () {
    Route::get('/signin', [AdminSigninController::class, 'index'])->name('admin-signin');
    Route::post('/signin', [AdminSigninController::class, 'validateCredentials'])->name('admin-validate-credentials');
});


Route::prefix('/dashboard/admin')->group(function () {
    Route::get('/kelola/lowongan', [DashboardController::class, 'adminManageVacancyPage'])->name('admin-manage-vacancy');
    Route::post('/kelola/lowongan/edit', [DashboardAdminController::class, 'editVacancy'])->name('admin-manage-vacnacy-edit');

    Route::get('/kelola/user/mahasiswa', [DashboardController::class, 'adminManageUserStudent'])->name('admin-manage-student');
    Route::get('/kelola/user/perusahaan', [DashboardController::class, 'adminManageUserCompany'])->name('admin-manage-company');
});
