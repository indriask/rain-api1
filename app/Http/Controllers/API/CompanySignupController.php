<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanySignupController extends Controller
{
    /**
     * Method untuk mem-proses logika signup perusahaan
     */
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:dns|present|string',
            'password' => 'required|string|min:8|confirmed|present',
            'nib' => 'required|min:9|max:10|present',
            'cooperation_file' => 'required|file|extensions:pdf,docx|present'
        ]);

        dd($validated);
    }
}
