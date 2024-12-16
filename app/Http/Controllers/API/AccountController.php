<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\ResponseController as Response;

use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Method untuk mem-proses logika signin mahasiswa dan perusahaan
     */
    public static function signin(Request $request)
    {
        try {
            //Memvalidasi request apakah email dan password sudah diisi
            $validated = $request->validate(
                [
                    'email' => 'required|string|email:dns|present',
                    'password' => 'required|string|present|min:8',
                ]
            );

            //Mencari data dalam database sesuai request apakah ada atau tidak
            if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
                $request->session()->regenerate(true);
                $request->session()->regenerateToken();

                return redirect()->intended('dashboard');
            }

            return back()->withErrors(['error' => 'Login gagal harap check Email atau Password Anda']);
        } catch (\Throwable $error) {
            //throw $error;
            // return back()->withErrors(['error' => 'Login gagal harap check Email atau Password Anda'])
            //     ->onlyInput('email');
            return back()->withErrors(['error' => $error->getMessage()])
                ->onlyInput('email');
        }
    }

    /**
     * Method untuk mem-proses logika signout mahasiswa, perusahaan dan admin
     */
    public static function signout(Request $request)
    {
        $data = [
            'code' => '',
            'message' => '',
            'data' => ''
        ];

        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $data['code'] = 302;
            $data['message'] = 'Berhasil logout!';

            return response()->json($data, 200);
        } catch (\Throwable $e) {
            $data['code'] = 500;
            $data['message'] = "Terjadi kesalahan saat proses logout";

            return response()->json($data, 200);
        }
    }

    /**
     * Mehot untuk mem-proses logika hapus akun mahasiswa dan perusahaan
     */
    public function deleteAccount(Request $request) {}
}
