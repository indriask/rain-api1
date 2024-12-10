<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentSignupController extends Controller
{
    /**
     * Method untuk mem-proses logika signup mahasiswa
     */
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'nim' => 'required|min:10|max:10'
        ]);

        // Hash password
        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'student';

        // Simpan data ke database
        $user = User::create($validated);

        $student = Student::create(
            ['nim' => $request->nim, 'id_user' => $user->id]
        );


        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('signin')->with('success', 'Berhasil registrasi, silakan login!');
    }
}
