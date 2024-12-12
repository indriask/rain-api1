<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanySignupController extends Controller
{
    /**
     * Method untuk mem-proses logika signup perusahaan
     */
    public function signup(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email:dns|present|string',
                'password' => 'required|string|min:8|confirmed|present',
                'nib' => 'required|min:9|max:10|present',
                'cooperation_file' => 'required|file|mimes:pdf,docx|present|'
            ]);

            // mengembalikan ukuran file upload dengan format byte
            if ($validated['cooperation_file']->getSize() > 2000000) {
                return back()->withErrors('error', 'Ukuran file harus dibawah 2MB')
                    ->withInput(['email', 'nib']);
            }

            $validated['password'] = Hash::make($validated['password']);

            // input data ke dalam database
            $user = User::create([
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => 'company',
                'created_date' => date('Y-m-d', time())
            ]);

            $profile = Profile::create([
                'photo_profile' => 'http://localhost:8000/storage/profile.jpg'
            ]);

            Company::create([
                'nib' => $validated['nib'],
                'id_user' => $user->id_user,
                'id_profile' => $profile->id_profile,
                'cooperation_file' => $validated['cooperation_file']->store('cooperation_folder')
            ]);

            //  tandai user sudah login tapi belum verifikasi email
            Auth::login($user);

            event(new Registered($user));
            return redirect()->route('verification.notice');
        } catch (\Throwable $e) {
            return back()->withErrors([['error' => 'Signin gagal, harap check data yang anda masukan!']])
                ->onlyInput('email', 'nib');
        }
    }
}
