<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    /**
     * Render halaman profile perusahaan
     */
    public function index() {
        return response()->view('company.profile');
    }
}
