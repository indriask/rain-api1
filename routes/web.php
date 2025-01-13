<?php

use App\Http\Controllers\api\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Middleware\isCompanyVerified;
use App\Http\Middleware\IsRequestAjax;
use App\Http\Middleware\IsRoleAdmin;
use App\Http\Middleware\IsRoleCompany;
use App\Http\Middleware\IsRoleStudent;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\isReadable;

// Routing ke halaman branding RAIN
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::redirect('/index', '/', 302);

// user tidak harus login untuk masuk ke route ini
Route::middleware('guest')->group(function () {
    Route::get('/signin', [IndexController::class, 'signinPage'])->name('login');
    Route::get('/signin', [IndexController::class, 'signinPage'])->name('signin');
    Route::get('/admin/signin', [IndexController::class, 'signinAdminPage'])->name('admin-singin');
    Route::get('/mahasiswa/signup', [IndexController::class, 'signupStudentPage'])->name('student-signup');
    Route::get('/perusahaan/signup', [IndexController::class, 'signupCompanyPage'])->name('company-signup');
});

// Routng untuk system forgot password
Route::get('/forgot-password', [ResetPasswordController::class, 'passwordRequest'])->name('password.request');
Route::get('/forgot-password/{token}', [ResetPasswordController::class, 'passwordReset'])->name('password.reset');

// user harus login dan email terverifikasi untuk masuk
// ke route ini
Route::middleware(['auth', 'verified'])->group(function () {
    // Routing untuk hadnle dashboard mahasiswa, perusahaan dan admin
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/{id}', [DashboardController::class, 'getVacancyDetail'])
        ->name('dashboard.view')
        ->whereNumber('id')
        ->middleware(IsRequestAjax::class);

    Route::get('/filter-vacancies-by-major', [DashboardController::class, 'filterVacanciesByMajor'])->name('filter.vacancies.by.major');
    Route::get('/filter-vacancies-by-title', [DashboardController::class, 'filterVacanciesByTitle'])->name('filter.vacancies.by.title');
    Route::get('/filter-vacancies-by-location', [DashboardController::class, 'filterVacanciesByLocation'])->name('filter.vacancies.by.location');
    Route::get('/filter-vacancies-clear', [DashboardController::class, 'clearFilters'])->name('filter.vacancies.clear');
    Route::get('/get-study-programs/{majorId}', [DashboardController::class, 'getStudyProgramsByMajor']);


    // Routing digunakan untuk handle dashboard mahasiswa
    Route::get('/dashboard/mahasiswa/list/lamaran', [DashboardController::class, 'studentProposalListPage'])
        ->name('student-proposal-list')
        ->middleware(IsRoleStudent::class);

    Route::get('/dashboard/mahasiswa/list/lamaran/{id}', [DashboardController::class, 'getProposalDetail'])
        ->whereNumber('id')
        ->middleware(IsRoleStudent::class, IsRequestAjax::class);

    Route::get('/dashboard/mahasiswa/profile', [DashboardController::class, 'studentProfilePage'])
        ->name('student-profile');

    // Route::post('dashboard/mahasiswa/update-profile', [DashboardAdminController::class, 'updateProfile'])
    //     ->name('mahasiswa.updateProfile')
    //     ->middleware(IsRoleStudent::class);

    Route::post('/apply', [DashboardController::class, 'apply'])
        ->name('apply')
        ->middleware(StartSession::class, IsRoleStudent::class);

    Route::get('/get-student-profile', [DashboardController::class, 'getStudentProfileData'])
        ->middleware(IsRoleStudent::class, IsRequestAjax::class);

    Route::post('/student/update-profile', [DashboardController::class, 'updateProfile'])
        ->name('student.updateProfile')
        ->middleware(IsRoleStudent::class);


    // Routing digunakan untuk handle dashboard perusahaan
    Route::get('/dashboard/perusahaan/kelola/lowongan/{id?}', [DashboardController::class, 'companyManageVacancyPage'])
        ->name('company-manage-vacancy')
        ->whereNumber('id')
        ->middleware(IsRoleCompany::class);

    Route::get('/dashboard/perusahaan/daftar/pelamar/{id?}', [DashboardController::class, 'companyApplicantPage'])
        ->name('company-applicant-list')
        ->whereNumber('id')
        ->middleware(IsRoleCompany::class);

    Route::get('/dashboard/perusahaan/daftar/pelamar/download/{id?}', [DashboardController::class, 'companyDownloadProposal'])
        ->whereNumber('id')
        ->middleware(IsRoleCompany::class, isCompanyVerified::class);

    Route::get('/dashboard/perusahaan/profile', [DashboardController::class, 'companyProfilePage'])
        ->name('company-profile');

    // Routing digunakan untuk handle dashboard admin
    Route::get('/dashboard/admin/kelola/user/mahasiswa', [DashboardController::class, 'adminManageUserStudent'])
        ->name('admin-manage-user-student')
        ->middleware(IsRoleAdmin::class);

    Route::get('/dashboard/admin/kelola/user/mahasiswa/{id}', [DashboardController::class, 'adminViewUserStudent'])
        ->name('admin-view-user-student')
        ->whereNumber('id')
        ->middleware(IsRoleAdmin::class);

    Route::get('/dashboad/admin/kelola/user/perusahaan', [DashboardController::class, 'adminManageUserCompany'])
        ->name('admin-manage-user-company')
        ->middleware(IsRoleAdmin::class);

    Route::get('/dashboad/admin/kelola/user/perusahaan/{id}', [DashboardController::class, 'adminViewUserCompany'])
        ->name('admin-view-user-company')
        ->whereNumber('id')
        ->middleware(IsRoleAdmin::class);

    Route::get('/dashboard/admin/download/cooperation-file/{id}', [DashboardController::class, 'adminDownloadCooperationFile'])
        ->whereNumber('id')
        ->middleware(IsRoleAdmin::class);

    Route::get('/dashboard/admin/profile', [DashboardController::class, 'adminProfilePage'])
        ->name('admin-profile');

    // Route untuk download file
    Route::get('/download-proposal/{name}', [DashboardController::class, 'downloadProposal'])
        ->middleware(IsRoleCompany::class, isCompanyVerified::class);

    Route::get('/download-cooperation-file/{name}', [DashboardController::class, 'downloadCooperationFile'])
        ->middleware(IsRoleAdmin::class);
});

Route::get('/lowongan', [DashboardController::class, 'getLowongan']);
Route::get('/lowongan/filter', [DashboardController::class, 'filterLowongan']);
Route::get('/jurusan', [DashboardController::class, 'getJurusan']);
Route::get('/prodi', [DashboardController::class, 'getProdi']);
Route::get('/lokasi', [DashboardController::class, 'getLokasi']);

// Route untuk handle halaman verifikasi email
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [DashboardController::class, 'verifyRegisteredEmailPage'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [DashboardController::class, 'verifyRegisteredEmail'])->name('verification.verify')
        ->middleware('signed');
});

// Route untuk testing
Route::get('/test', function () {
    dd(request()->session()->all());
});
