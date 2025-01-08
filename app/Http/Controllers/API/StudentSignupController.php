<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailVerification;
use App\Models\Profile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentSignupController extends Controller
{
    /**
     * Method untuk mem-proses logika signup mahasiswa
     */
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:dns|present|unique:users,email',
            'name' => 'required|string|max:255|present',
            'password' => 'required|string|min:8|confirmed|present',
            'nim' => 'required|min:9|max:10|unique:student,nim'
        ]);

        try {
            // Hash password
            $validated['password'] = bcrypt($validated['password']);
            $validated['name'] = explode(' ', $validated['name'], 2);
            $validated['created_at'] = date('Y-m-d', time());

            $first_name = $validated['name'][0] ?? 'Username';
            $last_name = $validated['name'][1] ?? '';
            $validated['role'] = 1;

            // Simpan data ke database
            $user = User::create($validated);

            $profile = Profile::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'photo_profile' => 'default/profile.png'
            ]);

            Student::create([
                'nim' => $validated['nim'],
                'id_user' => $user->id_user,
                'id_profile' => $profile->id_profile,
            ]);

            // mark user as authenticated but not verified
            Auth::login($user);

            // mengirim email verifikasi kepada user
            event(new Registered($user));
            return redirect()->route('verification.notice');
        } catch (\Throwable $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat melakukan proses signup, silahkan coba lagi!'])
                ->onlyInput('email', 'name', 'nim');
        }
    }
}
