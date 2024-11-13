<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SigninController;


Route::post('/signin', [SigninController::class, 'signin']);
