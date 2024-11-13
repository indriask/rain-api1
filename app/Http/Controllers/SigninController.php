<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SigninController extends Controller
{

    public function index(){
        return view('signin');
    }

    public function signin(Request $request){

        try {
            //Memvalidasi request apakah email dan password sudah diisi
            $validated = $request->validate(
                [
                    'email_or_phone' => 'required',
                    'password' => 'required',
                ]
            );

            //Mencari data dalam database sesuai request apakah ada atau tidak
            if(Auth::attempt(['email' => $request->email_or_phone , 'password' => $request->password])){
                $user = User::where('email' , $request->email_or_phone)->first();
                Auth::login($user);
                return redirect()->route('dashboard');
            }else{
                return redirect()->back()->withErrors('Login gagal harap check email atau password anda');
            }

        } catch (\Throwable $error) {
            //throw $error;
            return redirect()->back()->withErrors($error->getMessage());
        }
    }

   
}
