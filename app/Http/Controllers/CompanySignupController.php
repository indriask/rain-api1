<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanySignupController extends Controller
{
    /**
     * Method untuk me-render halaman signup perusahaan
     */
    public function index() {
        return response()->view('company.signup', [
            'title' => 'Signup Perusahaan | RAIN'
        ]);
    }

    /**
     * Method untuk mem-proses logika pembuatan akun perusahaan
     */
    public function doSignup(Request $request) {
        return 1;
    }
}
