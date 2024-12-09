<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class SigninController extends Controller
{
<<<<<<< HEAD
    /**
     * Method untuk me-render halaman signin mahasiswa dan perusahaan
     */
=======
>>>>>>> c6efe51c5ae24bc550f217dd1fb39696f1de8917
    public function index()
    {
        return view('signin');
    }

<<<<<<< HEAD
    /**
     * Method untuk mem-proses logika signin mahasiswa dan perusahaan
     */
    public function signin(Request $request)
    {
        dd($request->all());
=======
    public function validateCredentials(Request $request)
    {
>>>>>>> c6efe51c5ae24bc550f217dd1fb39696f1de8917
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

<<<<<<< HEAD
            $data = [
                'email' => $request->email_or_phone,
                'password' => $request->password
            ];
            $response = Http::asForm()->post('http://localhost/RAIN/public/api/signin', $data);

            if ($response->successful()) {
                // Anda bisa menangani token atau data respons API di sini, misalnya menyimpan token session
                // Misalnya jika API mengembalikan token JWT, Anda bisa menyimpannya di session
                session(['api_token' => $response->json('token')]); // Contoh menyimpan token

                // Redirect ke dashboard setelah login berhasil
                return redirect()->route('dashboard');
            } else {
                // Menangani kesalahan jika login gagal
                return redirect()->back()->withErrors('Login gagal. Periksa email/telepon atau password.');
            }

=======
            // Cek apakah data ada di tabel `users`
            $user = \App\Models\User::where('email', $request->email)->first();

            if (!$user) {
                return redirect()->back()->withErrors('Email tidak ditemukan.');
            }
>>>>>>> c6efe51c5ae24bc550f217dd1fb39696f1de8917

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
