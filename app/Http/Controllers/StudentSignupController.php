<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentSignupController extends Controller
{
    // Render halaman signup untuk mahasiswa
    public function index() {
        return response()->view('student.signup', [
            'title' => 'Signup | RAIN'
        ]);
    }

    // Membuat akun untuk mahasiswa
    public function doSignup(Request $request) {
        return 1;
    }
}
