<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\SearchController;



Route::post('/signin', [AccountController::class, 'signin']);
Route::post('/signup', [AccountController::class, 'signup']);
Route::post('/signout', [AccountController::class, 'signout']);
Route::post('/search/company', [SearchController::class, 'searchPerusahaan']);