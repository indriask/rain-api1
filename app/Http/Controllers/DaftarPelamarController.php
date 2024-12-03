<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaftarPelamarController extends Controller
{
    public function index() {
        return response()->view('company.daftar-pelamar', [
            'role' => 'company'
        ]);
    }
}
