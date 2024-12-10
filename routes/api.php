<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\SearchController;



Route::post('/signin', [AccountController::class, 'signin'])->name('api-validate-signin');
Route::post('/signup', [AccountController::class, 'signup'])->name('api-validate-signup');
Route::post('/signout', [AccountController::class, 'signout'])->name('api-validate-signout');
Route::post('/search/company', [SearchController::class, 'searchPerusahaan']);