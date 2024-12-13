<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\api\CompanyProfileController;
use App\Http\Controllers\api\CompanySignupController;
use App\Http\Controllers\api\DashboardAdminController;
use App\Http\Controllers\api\DashboardCompanyController;
use App\Http\Controllers\api\DashboardStudentController;
use App\Http\Controllers\api\ResetPasswordController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\api\StudentProfileController;
use App\Http\Controllers\api\StudentSignupController;
use App\Http\Controllers\api\VerifyEmailController;

/**
 * INFORMASI PENTING!!!!!
 * 
 * SEMUA NAMA AWAL ROUTE DI FILE INI SECARA OTOMATIS AKAN DITAMBAHKAN KATA '/api' OLEH LARAVEL.
 * JIKA MAU MENGGUNAKANNYA PADA FETCH JS HARAP TAMBAHKAN KATA '/api' PADA AWAL NAMA ROUTE NYA, CONTOH
 * 
 * /signin => /api/signin 
 */


/**
 * INFORMASI PENTING!!! HARAP DIBACA!!
 * 
 * JIKA INGIN MEMBUAT LOGIKA UNTUK MEM-PROSES DATA REQUEST, DIHARAPKAN MENGGUNAKAN
 * CONTROLLER YANG SUDAH DISIPKAN, MASING MASING CONTROLLER MEMPUNYAI KEGUNAAAN NYA 
 * MASING MASING. INI UNTUK KETENTRAMA KITA BERSAMA
 * 
 * FILE web.php dan api.php MEMPUNYAI KEGUNAAN MAING MAING
 * 1. web.php => hanya digunakan untuk menampilkan halaman view website
 * 2. api.php => hanya digunakan untuk mem-proses logika request dan response
 * 
 */

Route::middleware('guest')->group(function () {
    // Route untuk system signin mahasiswa dan perusahaan
    Route::post('/signin', [AccountController::class, 'signin'])->name('api-validate-signin');

    // Route untuk system signup mahasiswa 
    Route::post('/mahasiswa/signup', [StudentSignupController::class, 'signup'])->name('api-create-student-account');

    // Route untuk system signup perusahaan
    Route::post('/perusahaan/signup', [CompanySignupController::class, 'signup'])->name('api-create-company-account');

    // Route untuk system signup admin
    Route::post('/admin/signin', [AccountController::class, 'adminSignin'])->name('api-admin-validate-signin');
});


Route::middleware(['auth', 'verified'])->group(function () {
    // Route signout mahasiswa, perusahaan dan admin
    Route::post('/signout', [AccountController::class, 'signout'])->name('api-signout');

    // Route khusus system dashboard mahasiswa
    Route::post('/dashboard/mahasiswa/daftar/lamaran', [DashboardStudentController::class, 'applyVacancy'])->name('api-student-apply-vacancy');
    Route::post('/dashboard/mahasiswa/list/lamaran/status/lamaran', [DashboardStudentController::class, 'getProposalStatus'])->name('api-student-get-proposal-status');
    Route::post('/dashboard/mahasiswa/list/lamaran/status/wawancara', [DashboardStudentController::class, 'getInterviewStatus'])->name('api-student-get-interview-status');
    Route::post('/dashboard/mahasiswa/profile/edit', [StudentProfileController::class, 'editProfile'])->name('api-student-edit-profile');
    Route::post('/dashboard/mahasiswa/profile/delete/account', [AccountController::class, 'deleteAccount'])->name('api-delete-account');

    // Route khusus system dashboard perusahaan
    Route::post('/dashboard/perusahaan/tambah/lowongan', [DashboardCompanyController::class, 'addVacancy'])->name('api-add-vacancy-page');
    Route::post('/dashboard/perusahaan/kelola/lowongan/edit', [DashboardCompanyController::class, 'editVacancy'])->name('api-company-edit-vacancy');
    Route::post('/dashboard/perusahaan/daftar/pelamar/delete/pelamar', [DashboardCompanyController::class, 'deleteApplicant'])->name('api-company-delete-applicant');
    Route::post('/dashboard/perusahaan/perbarui/status', [DashboardCompanyController::class, 'updateStatusApplicant'])->name('api-company-update-status-applicant');
    Route::post('/dashboard/perusahaan/profile/edit', [CompanyProfileController::class, 'editProfile'])->name('api-company-edit-profile');
    Route::post('/dashboard/perusahaan/profile/delete/account', [AccountController::class, 'deleteAccount'])->name('api-company-delete-account');

    // Route khusus untuk system dashboard admin
    Route::post('/dashboard/admin/kelola/lowongan/edit', [DashboardAdminController::class, 'editVacancy'])->name('api-admin-manage-vacnacy-edit');
    Route::post('/dashboard/admin/kelola/user/mahasiswa', [DashboardAdminController::class, 'manageUserStudent'])->name('api-admin-manage-student');
    Route::post('/dashboard/admin/kelola/user/perusahaan', [DashboardAdminController::class, 'manageUserVacancy'])->name('api-admin-manage-company');
});

Route::middleware('auth')->group(function () {
    // Route untuk mengirim kembali verifikasi email
    Route::post('/email/verification-notification', [VerifyEmailController::class, 'sendRegisteredEmailVerification'])
        ->middleware('throttle:6,1')->name('verification.send');
});

Route::post('/search/company', [SearchController::class, 'searchPerusahaan']);

// Route untuk system forgot password
Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail'])
    ->name('password.email');

Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])
    ->name('password.update');
