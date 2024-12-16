<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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
        // dd($request->all());
        try {
            $validated = $request->validate([
                'email' => 'required|email:dns|present|unique:users,email',
                'name' => 'required|string|max:255|present',
                'password' => 'required|string|min:8|confirmed|present',
                'nim' => 'required|min:9|max:10'
            ]);

            // Hash password
            $validated['password'] = bcrypt($validated['password']);
            $validated['role'] = 1;
            $validated['name'] = explode(' ', $validated['name']);

            $validated['created_at'] = date('Y-m-d', time());
            $first_name = $validated['name'][0] ?? null;
            $last_name = $validated['name'][1] ?? null;

            // Simpan data ke database
            $user = User::create($validated);

            $profile = Profile::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'photo_profile' => '/default/profile.png'
            ]);

            $student = Student::create([
                'nim' => $validated['nim'],
                'id_user' => $user->id_user,
                'id_profile' => $profile->id_profile
            ]);

            // mark user as authenticated but not verified
            Auth::login($user);

            event(new Registered($user));
            return redirect()->route('verification.notice');
        } catch (\Throwable $e) {
            // return back()->withErrors(['error' => 'Signin gagal, harap check data yang anda masukan!'])
            //     ->onlyInput('email', 'nim', 'nama');
            return back()->withErrors(['error' => $e->getMessage()])
                ->onlyInput('email', 'nim', 'nama');
        }
    }
}
