<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function index()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'email' => ['required|email|unique:users,email'],
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Hash password
            $validated['password'] = bcrypt($validated['password']);
            
            // Simpan data ke database
            User::create($validated);

            // Redirect ke halaman login dengan pesan sukses
            return redirect()->route('signin')->with('success', 'Berhasil registrasi, silakan login!');
        } catch (\Exception $e) {
            // Tangani error
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
