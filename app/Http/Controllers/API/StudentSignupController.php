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
        try {
            $validated = $request->validate([
                'email' => 'required|email:dns|present',
                'name' => 'required|string|max:255|present',
                'password' => 'required|string|min:8|confirmed|present',
                'nim' => 'required|min:9|max:10'
            ]);

            // Hash password
            $validated['password'] = bcrypt($validated['password']);
            $validated['role'] = 'student';
            $validated['name'] = explode(' ', $validated['name']);

            $validated['created_at'] = date('Y-m-d', time());
            $first_name = $validated['name'][0];
            $last_name = $validated['name'][1] ?? '';
            $validated['role'] = 1;

            // Simpan data ke database
            $user = User::create($validated);

            $profile = Profile::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'photo_profile' => 'http://localhost:8000/storage/profile.jpg'
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
        }   catch (\Throwable $e) {
            return response()->json(['message' => 'Error terjadi', 'error' => $e->getMessage()], 500);
       
        }
    }
}
