<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SigninController extends Controller
{
    public function index()
    {
        return response()->view('signin');
    }

    public function validateCredentials(Request $request) {
        return redirect()->route('dashboard');
    }
}
