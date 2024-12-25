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
        // Memvalidasi request apakah email dan password sudah diisi
        $validated = $request->validate(
            [
                'email' => 'required|string|email:dns|present',
                'password' => 'required|string|present|min:8',
            ]
        );

        try {
            // Mencoba login dengan email dan password yang telah divalidasi
            if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], true)) {
                // Regenerasi session dan token untuk meningkatkan keamanan
                $request->session()->regenerate();
                $request->session()->regenerateToken();

                // Redirect ke halaman dashboard jika login berhasil
                return redirect()->intended('dashboard');
            } else {
                // Jika login gagal, kembalikan pesan error
                return back()->withErrors(['error' => 'Email atau password salah.'])->onlyInput('email');
            }
        } catch (\Throwable $error) {
            // Menangkap error yang terjadi dan menampilkan pesan error generik
            return back()->withErrors(['error' => 'Terjadi kesalahan, silakan coba lagi.'])->onlyInput('email');
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

    // proses signin akun admin
    public function adminSignin(Request $request)
    {
        // Memvalidasi request apakah email dan password sudah diisi
        $validated = $request->validate(
            [
                'email' => 'required|string|email:dns|present',
                'password' => 'required|string|present|min:8',
            ]
        );

        try {
            // Mencoba login dengan email dan password yang telah divalidasi
            if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], true)) {
                // Regenerasi session dan token untuk meningkatkan keamanan
                $request->session()->regenerate();
                $request->session()->regenerateToken();

                // Redirect ke halaman dashboard jika login berhasil
                return redirect()->intended('dashboard');
            } else {
                // Jika login gagal, kembalikan pesan error
                return back()->withErrors(['error' => 'Email atau password salah.'])->onlyInput('email');
            }
        } catch (\Throwable $error) {
            // Menangkap error yang terjadi dan menampilkan pesan error generik
            return back()->withErrors(['error' => 'Terjadi kesalahan, silakan coba lagi.'])->onlyInput('email');
        }
    }
}
