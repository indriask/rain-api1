<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\ResponseController as Response;
use App\Models\Profile;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    protected $roles = ['student', 'company', 'admin'];

    // proses signin mahasiswa dan perusahaan
    public static function signin(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|string|email:dns|present',
                'password' => 'required|string|present|min:8',
            ]
        );

        try {
            if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], true)) {
                $request->session()->regenerate();
                $request->session()->regenerateToken();

                return redirect()->intended('dashboard');
            } else {
                return back()->withErrors(['error' => 'Email atau password salah.'])->onlyInput('email');
            }
        } catch (\Throwable $error) {
            return back()->withErrors(['error' => 'Terjadi kesalahan, silakan coba lagi.'])->onlyInput('email');
        }
    }

    // proses logout mahasiswa, perusahaan dan admin
    public function signout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json($this->setResponse(
                success: true,
                title: 'Berhasil logout',
                message: 'Anda berhasil logout dari aplikasi',
                icon: asset('storage/svg/success-checkmark.svg'),
                additional: ['code' => 302]
            ), 200);
        } catch (\Throwable $e) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Reqeust ditolak',
                message: 'Terjadi kesalahaan saat proses logout, harap coba lagi',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }
    }

    /**
     * Mehot untuk mem-proses logika hapus akun mahasiswa dan perusahaan
     */
    public function deleteAccount(Request $request)
    {
        try {
            $user = auth('web')->user();
            Profile::where('id_profile', $user->id_user)->delete();
            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json($this->setResponse(
                success: true,
                title: 'Berhasil hapus akun',
                message: 'Akun anda berhasil di hapus dari system RAIN',
                icon: asset('storage/svg/success-checkmark.svg')
            ), 200);
        } catch (\Throwable $e) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Request error',
                message: 'Terjadi kesalahaan saat melakukan request',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }
    }

    // proses signin akun admin
    public function adminSignin(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|string|email:dns|present',
                'password' => 'required|string|present|min:8',
            ]
        );

        try {
            if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password'], 'role' => 3], true)) {
                $request->session()->regenerate();
                $request->session()->regenerateToken();

                return redirect()->intended('dashboard');
            } else {
                return back()->withErrors(['error' => 'Email atau password salah.'])->onlyInput('email');
            }
        } catch (\Throwable $error) {
            return back()->withErrors(['error' => $error->getMessage()])->onlyInput('email');
        }
    }

    // method untuk menghasilkan response request
    private function setResponse(
        bool $success = true,
        string $title = '',
        string $message = '',
        string $type = '',
        string $icon = '',
        array $additional = []
    ): array {
        $response = [
            'success' => $success,
            'notification' => [
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'icon' => $icon
            ]
        ];

        if ($additional !== []) {
            $response['additional'] = $additional;
        }

        return $response;
    }
}
