<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    // render halaman email tujuan forgot password
    public function passwordRequest()
    {
        return response()->view('forgot-password');
    }

    // proses email dan kirim email password reset link
    public function passwordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT ?
            back()->with(['status' => __($status)]) :
            back()->withErrors(['email' => __($status)]);
    }

    // render halaman ubah password
    public function passwordReset(string $token)
    {
        return response()->view('auth.reset-password', ['token' => $token]);
    }

    // proses request reset password
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET ?
            redirect()->route('signin')->with('status', __($status)) :
            back()->withErrors(['email' => __($status)]);
    }
}
