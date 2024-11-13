<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::redirect('/index', '/', 302);

// Route halaman branding RAIN
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

// Route halaman signin, signup dan forget-password
Route::get('/signin', [SigninController::class, 'index'])->name('signin');
Route::post('/signin', [SigninController::class, 'signin'])->name('signin-next');
Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::post('/signup', [SignupController::class, 'register'])->name('signup-post');

Route::get('/forget-password', [ForgetPasswordController::class, 'index'])->name('forget-password');

// Route halaman dashboard mahasiswa dan perusahaan
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/detail/{lowongan}', [DashboardController::class, 'detailLowongan'])->name('detail-lowongan');
Route::get('/dashboard/search/{lowongan}', [DashboardController::class, 'search'])->name('search-lowongan');

// Route halaman profile mahasiswa dan perusahaan
Route::get('/dashboard/student/profile', [StudentController::class, 'index'])->name('student-profile');
Route::get('/dashboard/company/profile', [CompanyController::class, 'index'])->name('company-profile');

Route::post('/makanbang', function () {

})->name('makanbang');

// Route halaman pasang lowongan untuk perusahaan
Route::get('/dashboard/company/pasang-lowongan', [DashboardController::class, 'pasangLowongan'])->name('pasang-lowongan');
