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

            // Tambah codingan disini untuk Panggil API pskr Http request
            

            return redirect()->route('dashboard');

        } catch (\Throwable $error) {
            //throw $error;
            return redirect()->back()->withErrors($error->getMessage());
        }
    }

   
}
