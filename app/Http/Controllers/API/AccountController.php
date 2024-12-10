<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\ResponseController as Response;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserRole;

class AccountController extends Controller
{
    /**
     * Method untuk mem-proses logika signin mahasiswa dan perusahaan
     */
    public static function signin (Request $request){
        try {
            //Memvalidasi request apakah email dan password sudah diisi
            $validated = $request->validate(
                [
                    'email' => 'required|string|email|unique',
                    'password' => 'required',
                ]
            );

            //Mencari data dalam database sesuai request apakah ada atau tidak
            if(Auth::attempt(['email' => $request->email , 'password' => $request->password])){
                // Check if  Role ID is correct too
                $user = User::where('email' , $request->email)->first();
                Auth::login($user);
                $data = [
                    'email' => $user->email
                ];
                Response::send($data);
            } else{
                Response::badRequest('Login gagal harap check Email atau Password Anda');
            }

        } catch (\Throwable $error) {
            //throw $error;
            Response::badRequest($error->getMessage());
        }
    }
        

    // public static function signup (Request $request){
    //     $user = User::find(1);
    //     Response::send(UserRole::find(2)->users);
    // }

    /**
     * Method untuk mem-proses logika signout mahasiswa, perusahaan dan admin
     */
    public static function signout (Request $request){
        return "Signout";
    }
}
