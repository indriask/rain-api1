<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgetPasswordController extends Controller
{
    public function index()
    {
        return response()->view('forget-password');
    }


    public function sendEmail(Request $request){
        $user = User::where('email' , $request->email)->first();
        if($user){
            $token = Password::createToken($user);

            $resetUrl = url(route('password.reset', ['token' => $token, 'email' => $user->email]));

            Mail::to($user->email)->send(new ResetPassword($resetUrl));

            return redirect()->route('signin')->with('success', 'Password reset link has been sent to your email.');

        }else{
            return back()->with('error','Ops, user dengan email '.$request->email.' tidak ditemukan');
        }
    }


    public function formResetPassword($token , $email){
        
        $user =  User::where('email', $email)->first();

        
        $response = Password::broker()->tokenExists(
            $user, $token
         );   
        
    
        if (!$response) {
            // Token is invalid
            return redirect()->route('signin')->with('error','Ops, token tidak valid silahkan lakuakn reset password ulang yaa');
        }

        return view('reset' , ['token'=> $token,'email'=> $email]);

    }


    public function updatePassword(Request $request , $token , $email){
        $request->validate(
           [ 'password' => 'required|confirmed|min:6',]      
          );
        $user =  User::where('email', $email)->first();
        $response = Password::broker()->tokenExists(
           $user, $token
        );          

        if($response){
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('signin')->with('success','Berhasil memperbarui password silahkan login !');
            
        }else{
            return back()->withErrors(['Token atau email tidak valid!']);
        }

    }
}
