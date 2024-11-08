<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanySignupController extends Controller
{
    // Render halaman signup untuk perusahaan
    public function index() {
        return response()->view('company.signup');
    }

    // Membuat akun untuk perusahaan
    public function doSignup(Request $request) {
        return 1;
    }
}
