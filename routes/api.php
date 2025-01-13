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
use App\Http\Controllers\IndexController;
use App\Http\Middleware\isCompanyVerified;
use App\Http\Middleware\IsRequestAjax;
use App\Http\Middleware\IsRoleAdmin;
use App\Http\Middleware\IsRoleCompany;
use App\Http\Middleware\IsRoleStudent;

// route untuk handle pengiriman feedback
Route::post('/send-feedback', [IndexController::class, 'sendFeedback'])
    ->middleware(IsRequestAjax::class);

Route::middleware(['guest', 'web'])->group(function () {
    // Route untuk system signin mahasiswa dan perusahaan
    Route::post('/signin', [AccountController::class, 'signin'])->name('api-validate-signin');

    // Route untuk system signup mahasiswa 
    Route::post('/mahasiswa/signup', [StudentSignupController::class, 'signup'])->name('api-create-student-account');

    // Route untuk system signup perusahaan
    Route::post('/perusahaan/signup', [CompanySignupController::class, 'signup'])->name('api-create-company-account');

    // Route untuk system signup admin
    Route::post('/admin/signin', [AccountController::class, 'adminSignin'])->name('api-admin-validate-signin');
});

Route::middleware(['auth', 'verified', 'web'])->group(function () {
    // Route signout mahasiswa, perusahaan dan admin
    Route::post('/signout', [AccountController::class, 'signout'])->name('api-signout');

    // Route digunakan untuk handle dashboad mahasiswa
    Route::post('/dashboard/mahasiswa/daftar/lamaran', [DashboardStudentController::class, 'applyVacancy'])->name('api-student-apply-vacancy')
        ->middleware(IsRoleStudent::class);

    Route::post('/dashboard/mahasiswa/list/lamaran/status/lamaran', [DashboardStudentController::class, 'getProposalStatus'])->name('api-student-get-proposal-status')
        ->middleware(IsRoleStudent::class);

    Route::post('/dashboard/mahasiswa/list/lamaran/status/wawancara', [DashboardStudentController::class, 'getInterviewStatus'])
        ->name('api-student-get-interview-status')
        ->middleware(IsRoleStudent::class);

    Route::post('/dashboard/mahasiswa/profile/edit', [StudentProfileController::class, 'editProfile'])
        ->name('api-student-edit-profile')
        ->middleware(IsRoleStudent::class);

    Route::post('/dashboard/mahasiswa/profile/delete/account', [AccountController::class, 'deleteAccount'])
        ->name('api-delete-account')
        ->middleware(IsRoleStudent::class);

    /**
     * Route untuk system dashboard perusahaan
     */
    Route::post('/dashboard/perusahaan/tambah/lowongan', [DashboardCompanyController::class, 'addVacancy'])
        ->name('api-add-vacancy-page')
        ->middleware(IsRoleCompany::class, isCompanyVerified::class);

    Route::post('/dashboard/perusahaan/kelola/lowongan/edit', [DashboardCompanyController::class, 'editVacancy'])
        ->name('api-company-edit-vacancy')
        ->middleware(IsRoleCompany::class, isCompanyVerified::class);

    Route::post('/dashboard/perusahaan/kelola/lowongan/delete', [DashboardCompanyController::class, 'deleteVacancy'])
        ->name('api-company-delete-vacancy')
        ->middleware(IsRoleCompany::class, isCompanyVerified::class);

    Route::post('/dashboard/perusahaan/daftar/pelamar/delete', [DashboardCompanyController::class, 'deleteApplicant'])
        ->name('api-company-delete-applicant')
        ->middleware(IsRoleCompany::class, isCompanyVerified::class);

    Route::post('/dashboard/perusahaan/daftar/pelamar/update-status/proposal', [DashboardCompanyController::class, 'updateStatusApplicantProposal'])
        ->middleware(IsRoleCompany::class, isCompanyVerified::class);

    Route::post('/dashboard/perusahaan/daftar/pelamar/update-status/interview', [DashboardCompanyController::class, 'updateStatusApplicantInterview'])
        ->middleware(IsRoleCompany::class, isCompanyVerified::class);

    Route::post('/dashboard/perusahaan/daftar/pelamar/interview-date', [DashboardCompanyController::class, 'setInterviewDate'])
        ->middleware(IsRoleCompany::class, isCompanyVerified::class);


    Route::post('/dashboard/perusahaan/profile/edit', [CompanyProfileController::class, 'editProfile'])
        ->middleware(IsRoleCompany::class, isCompanyVerified::class);

    Route::post('/dashboard/perusahaan/profile/delete/account', [AccountController::class, 'deleteAccount'])
        ->middleware(IsRoleCompany::class);

    /**
     * Route untuk system dashboard admin
     */
    Route::post('/dashboard/admin/kelola/lowongan/delete', [DashboardAdminController::class, 'deleteVacancy'])
        ->middleware(IsRoleAdmin::class);

    Route::post('/dashboard/admin/kelola/user/delete', [DashboardAdminController::class, 'deleteUser'])
        ->middleware(IsRoleAdmin::class);

    Route::post('/dashboard/admin/kelola/user/perusahaan/verify', [DashboardAdminController::class, 'verifyCompany'])
        ->middleware(IsRoleAdmin::class);

    Route::post('/dashboard/admin/profile/edit', [DashboardAdminController::class, 'editProfile'])
        ->middleware(IsRoleAdmin::class);
});


Route::middleware('auth')->group(function () {
    // Route untuk mengirim kembali verifikasi email
    Route::post('/email/verification-notification', [VerifyEmailController::class, 'sendRegisteredEmailVerification'])
        ->middleware('throttle:6,1')->name('verification.send');
});





Route::post('/search/company', [SearchController::class, 'searchPerusahaan']);

// Route untuk system forgot password
Route::middleware('web')->group(function () {
    Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail'])
        ->name('password.email');
    Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])
        ->name('password.update');
});
