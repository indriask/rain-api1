<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanySignupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentSignupController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Route redirect ke halaman home RAIN
Route::redirect('/index', '/', 302);

// Route halaman home RAIN
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

// Route halaman signin untuk perusahaan dan mahasiswa
Route::get('/signin', [SigninController::class, 'index'])->name('signin');
Route::post('/signin', [SigninController::class, 'validateCredentials'])->name('validate-credentials');

// Route halaman signup untuk mahasiswa
Route::get('/mahasiswa/signup', [StudentSignupController::class, 'index'])->name('student-signup');
Route::post('/mahasiswa/signup', [StudentSignupController::class, 'doSignup'])->name('do-student-signup');

// Route halaman signup untuk perusahaan
Route::get('/perusahaan/signup', [CompanySignupController::class, 'index'])->name('company-signup');
Route::post('/perusahaan/signup', [CompanySignupController::class, 'doSignup'])->name('do-company-signup');

// Route halaman forget-password
Route::get('/forget-password', [ForgetPasswordController::class, 'index'])->name('forget-password');

// Route halaman dashboard mahasiswa dan perusahaan
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route halaman profile mahasiswa
// Route::get('/dashboard/mahasiswa/profile', [StudentController::class, 'index'])->name('student-profile');

// Route halaman profile perusahaan
// Route::get('/dashboard/perusahaan/profile', [CompanyController::class, 'index'])->name('company-profile');

// Route halaman pasang lowongan untuk perusahaan
// Route::get('/dashboard/perusahaan/pasang-lowongan', [DashboardController::class, 'pasangLowongan'])->name('pasang-lowongan');