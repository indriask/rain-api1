<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function index()
    {
        return response()->view('signup');
    }

    public function register(Request $request)
    {
        try {
            //code...
            $validated = $request->validate(
                [
                    'email_or_phone' => 'required',
                    'password' => 'required|confirmed',
                    'name' => 'required'
                ]
            );

            $validated['email'] = $request->email_or_phone;
            $validated['password'] = bcrypt($request->password);

            unset($validated['email_or_phone']);
            $user = User::create($validated);
            return redirect()->route('signin')->with('success', 'Berhasil registrasi silahkan login !');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
}
