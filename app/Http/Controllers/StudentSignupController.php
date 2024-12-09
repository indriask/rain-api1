<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentSignupController extends Controller
{
    /**
     * Method untuk me-render halaman signup mahasiswa
     */
    public function index() {
        return response()->view('student.signup', [
            'title' => 'Signup Mahasiswa | RAIN'
        ]);
    }

    /**
     * Method untuk mem-proses logika pembuatan akun mahasiswa
     */
    public function doSignup(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'nim' =>'required'
        ]);

        // Hash password
        $validated['password'] = bcrypt($validated['password']);
        
        $validated['roles_id'] =1;
        // Simpan data ke database
        $user = User::create($validated);

        $student = Student::create(
            ['nim'=> $request->nim , 'id_user' => $user->id ]
        );


        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('signin')->with('success', 'Berhasil registrasi, silakan login!');    }
}
