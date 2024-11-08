<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupController extends Controller
{
    // Render halaman signup
    public function index()
    {
        return response()->view('signup');
    }

    // Menerima request pembuatan akun
    public function doSignup(Request $request) {
        return 1;
    }
}
