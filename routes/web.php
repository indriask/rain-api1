<?php

use App\Http\Controllers\AdminSigninController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CompanySignupController;
use App\Http\Controllers\DaftarPelamarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\StudentSignupController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route redirect ke halaman home RAIN
Route::redirect('/index', '/', 302);

// Route halaman home RAIN
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

// Route halaman signin untuk perusahaan dan mahasiswa
Route::get('/signin', [SigninController::class, 'index'])->name('signin');
Route::post('/signin', [SigninController::class, 'validateCredentials'])->name('validate-credentials');

/**
 * Route ke halaman signin untuk admin
 */
Route::get('/admin/signin', [AdminSigninController::class, 'index'])->name('admin-signin');
Route::post('/admin/signin', [AdminSigninController::class, 'validateCredentials', 'validateCredentials'])->name('admin-validate-credentials');

// Route halaman signup untuk mahasiswa
Route::get('/mahasiswa/signup', [StudentSignupController::class, 'index'])->name('student-signup');
Route::post('/mahasiswa/signup', [StudentSignupController::class, 'doSignup'])->name('do-student-signup');

// Route halaman signup untuk perusahaan
Route::get('/perusahaan/signup', [CompanySignupController::class, 'index'])->name('company-signup');
Route::post('/perusahaan/signup', [CompanySignupController::class, 'doSignup'])->name('do-company-signup');

// Route halaman dashboard mahasiswa dan perusahaan
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/mahasiswa/daftar-lamaran', [DashboardController::class, 'daftarLamaran'])->name('student-daftar-lamaran');

// Route untuk melihat status lamaran dan wawancara mahasiswa
Route::get('/dashboard/mahasiswa/daftar-lamaran/lamaran', [DashboardController::class, 'getLamaranStatus']);
Route::get('/dashboard/mahasiswa/daftar-lamanaran/wawancara', [DashboardController::class, 'getWawancaraStatus']);

// Route ke halaman profile mahasiswa
Route::get('/dashboard/mahasiswa/profile', [StudentProfileController::class, 'index'])->name('student-profile');

/**
 * Route ke halaman profile perusahaan
 */
Route::get('/dashboard/perusahaan/profile', [CompanyProfileController::class, 'index'])->name('company-profile');


// Route halaman forget-password
Route::get('/forget-password', [ForgetPasswordController::class, 'index'])->name('forget-password');
Route::post('/forget-password', [ForgetPasswordController::class, 'sendEmail'])->name('forget-password-post');
Route::post("/password/reset/{token}/{email}" , [ForgetPasswordController::class , "updatePassword"])->name('password.reset.post');
Route::get("/password/reset/{token}/{email}" , [ForgetPasswordController::class , "formResetPassword"])->name('password.reset');

/**
 * Route tambah lowongan untuk perusahaan
 */
Route::post('/dashboard/perusahaan/tambah/lowongan', [DashboardController::class, 'tambahLowongan']);

/**
 * Route kelola lowongan untuk perusahan
 */
Route::get('/dashboard/perusahaan/kelola/lowongan', [DashboardController::class, 'kelolaLowongan'])->name('company-manage-vacancy');

/**
 * Route untuk kelola daftar pelamar
 */
Route::get('/dashboard/perusahaan/daftar/pelamar', [DaftarPelamarController::class, 'index'])->name('company-proposal-list');

/**
 * Ini route dibuat untuk testing fitur atau halaman view.
 * mohon jangan di hapus
 */
Route::post('/test', function (Request $request) {
    // $email = $request->input('email');
    // return response()->json(['email' => explode('@', $email)[0]]);
    return response()->json(['data' => $request->file()]);
});