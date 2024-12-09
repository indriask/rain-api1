<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\ResponseController as Response;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserRole;

class SearchController extends Controller
{
    public static function searchPerusahaan (Request $request){
        try {
            //Memvalidasi request apakah email dan password sudah diisi
            $validated = $request->validate(
                [
                    'query' => 'required|string',
                ]
            );
            
            $users = User::whereLike('name','%'.$request->input('query').'%')
                            ->where('roles_id', 2)
                            ->get();


            Response::send($users);

        } catch (\Throwable $error) {
            //throw $error;
            Response::badRequest($error->getMessage());
        }
    }
        
}
