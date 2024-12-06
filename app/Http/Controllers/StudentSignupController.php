<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentSignupController extends Controller
{
    /**
     * Method untuk me-render halaman signup mahasiswa
     */
    public function index() {
        return response()->view('student.signup', [
            'title' => 'Signup Mahasiswa | RAIN'
        ]);
    }

    /**
     * Method untuk mem-proses logika pembuatan akun mahasiswa
     */
    public function doSignup(Request $request) {
        return 1;
    }
}
