<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SigninController extends Controller
{
    /**
     * Method untuk me-render halaman signin mahasiswa dan perusahaan
     */
    public function index()
    {
        return view('signin');
    }

    /**
     * Method untuk mem-proses logika signin mahasiswa dan perusahaan
     */
    public function signin(Request $request)
    {
        dd($request->all());
        try {
            //Memvalidasi request apakah email dan password sudah diisi
            $validated = $request->validate(
                [
                    'email_or_phone' => 'required',
                    'password' => 'required',
                ]
            );

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


            return redirect()->route('dashboard');
        } catch (\Throwable $error) {
            //throw $error;
            return redirect()->back()->withErrors($error->getMessage());
        }
    }
}
