<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    /**
     * Render halaman profile mahasiswa
     */
    public function index() {
        return response()->view('student.profile');
    }
}
