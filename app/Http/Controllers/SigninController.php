<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class SigninController extends Controller
{
    /**
     * Method untuk me-render halaman signin mahasiswa dan perusahaan
     */
    public function index()
    {
        return view('signin');
    }

    public function validateCredentials(Request $request)
    {

        dd($request->all());
        try {
            // Validasi input
            $validated = $request->validate(
                [
                    'email' => 'required|email',
                    'password' => 'required',
                ],
                [
                    'email.required' => 'Email wajib diisi.',
                    'email.email' => 'Format email tidak valid.',
                    'password.required' => 'Password wajib diisi.',
                ]
            );

            // Cek apakah data ada di tabel `users`
            $user = \App\Models\User::where('email', $request->email)->first();

            if (!$user) {
                return redirect()->back()->withErrors('Email tidak ditemukan.');
            }

            // Verifikasi password
            if (!Hash::check($request->password, $user->password)) {
                return redirect()->back()->withErrors('Password salah.');
            }

            // Simpan data user ke session
            Auth::login($user);


            // Redirect ke dashboard
            return redirect()->route('dashboard');
        } catch (\Throwable $error) {
            return redirect()->back()->withErrors('Terjadi kesalahan: ' . $error->getMessage());
        }
    }
}
