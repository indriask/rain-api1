<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index() {
        return response()->view('student.dashboard');
    }

    public function detailLowongan(string $lowongan) {
        return response()->view('student.detail-lowongan', [
            'lowongan' => $lowongan
        ]);
    }

    public function profile() {
        return response()->view('student.profile');
    }
}
