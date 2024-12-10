<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\api\CompanyProfileController;
use App\Http\Controllers\api\CompanySignupController;
use App\Http\Controllers\api\DashboardAdminController;
use App\Http\Controllers\api\DashboardCompanyController;
use App\Http\Controllers\api\DashboardStudentController;
use App\Http\Controllers\api\ForgetPasswordController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\api\StudentProfileController;
use App\Http\Controllers\api\StudentSignupController;
use App\Http\Controllers\DashboardController;

/**
 * INFORMASI PENTING!!!!!
 * 
 * SEMUA NAMA AWAL ROUTE DI FILE INI SECARA OTOMATIS AKAN DITAMBAHKAN KATA '/api' OLEH LARAVEL.
 * JIKA MAU MENGGUNAKANNYA PADA FETCH JS HARAP TAMBAHKAN KATA '/api' PADA AWAL NAMA ROUTE NYA, CONTOH
 * 
 * /signin => /api/signin 
 */

Route::post('/signin', [AccountController::class, 'signin'])->name('api-validate-signin');

Route::post('/mahasiswa/signup', [StudentSignupController::class, 'doSignup'])->name('api-create-student-account');
Route::post('/perusahaan/signup', [CompanySignupController::class, 'doSignup'])->name('api-create-company-account');

Route::post('/signout', [AccountController::class, 'signout'])->name('api-signout');
Route::post('/search/company', [SearchController::class, 'searchPerusahaan']);

/**
 * Route untuk system forget password
 */
Route::post('/forget-password', [ForgetPasswordController::class, 'sendEmail'])->name('forget-password-post');
Route::post('/password/reset/{token}/{email}', [ForgetPasswordController::class, 'updatePassword'])->name('password.reset.post');

/**
 * Route untuk system dashboard mahasiswa
 */
Route::post('/dashboard/mahasiswa/daftar/lamaran', [DashboardStudentController::class, 'applyVacancy'])->name('api-student-apply-vacancy');
Route::post('/dashboard/mahasiswa/list/lamaran/status/lamaran', [DashboardStudentController::class, 'getProposalStatus'])->name('api-student-get-proposal-status');
Route::post('/dashboard/mahasiswa/list/lamaran/status/wawancara', [DashboardStudentController::class, 'getInterviewStatus'])->name('api-student-get-interview-status');
Route::post('/dashboard/mahasiswa/profile/edit', [StudentProfileController::class, 'editProfile'])->name('api-student-edit-profile');
Route::post('/dashboard/mahasiswa/profile/delete/account', [AccountController::class, 'deleteAccount'])->name('api-delete-account');

/**
 * Route untuk system dashboard perusahaan
 */
Route::post('/dashboard/perusahaan/tambah/lowongan', [DashboardCompanyController::class, 'addVacancy'])->name('api-add-vacancy-page');
Route::post('/dashboard/perusahaan/kelola/lowongan/edit', [DashboardController::class, 'editVacancy'])->name('api-company-edit-vacancy');
Route::post('/dashboard/perusahaan/daftar/pelamar/delete/pelamar', [DashboardCompanyController::class, 'deleteApplicant'])->name('api-company-delete-applicant');
Route::post('/dashboard/perusahaan/perbarui/status', [DashboardCompanyController::class, 'updateStatusApplicant'])->name('api-company-update-status-applicant');
Route::post('/dashboard/perusahaan/profile/edit', [CompanyProfileController::class, 'editProfile'])->name('api-company-edit-profile');
Route::post('/dashboard/perusahaan/profile/delete/account', [AccountController::class, 'deleteAccount'])->name('api-company-delete-account');

/**
 * Route untuk system dashboard admin
 */
Route::post('/dashboard/admin/kelola/lowongan/edit', [DashboardAdminController::class, 'editVacancy'])->name('api-admin-manage-vacnacy-edit');
Route::post('/dashboard/admin/kelola/user/mahasiswa', [DashboardAdminController::class, 'manageUserStudent'])->name('api-admin-manage-student');
Route::post('/dashboard/admin/kelola/user/perusahaan', [DashboardAdminController::class, 'manageUserVacancy'])->name('api-admin-manage-company');