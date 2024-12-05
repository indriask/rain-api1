<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSigninController extends Controller
{
    /**
     * Render halaman signin admin
     */
    public function index() {
        return response()->view('admin.signin');
    }

    /**
     * Memproses data email dan password
     */
    public function validateCredentials(Request $request) {
        return $request->all();
    }
}
