<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgetPasswordController extends Controller
{
    /**
     * Method untuk mem-proses logika pengiriman email reset link
     */
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns|exists:users,email',
        ]);

        $status = Password::sendResetLink(['email' => $request->email]);

        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->route('signin')->with('success', 'Password reset link has been sent to your email.');
        }

        return back()->withErrors(['email' => __($status)]);
    }

    /**
     * Method untuk menampilkan halaman form reset password
     */
    public function formResetPassword($token, $email)
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Password::getRepository()->exists($user, $token)) {
            return redirect()->route('signin')->with('error', 'Ops, token tidak valid, silakan lakukan reset password ulang.');
        }

        return view('reset', ['token' => $token, 'email' => $email]);
    }

    /**
     * Method untuk mem-proses logika update password user
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('signin')->with('success', 'Berhasil memperbarui password, silakan login!');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
