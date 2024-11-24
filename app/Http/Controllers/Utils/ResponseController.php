<?php

namespace App\Http\Controllers\Utils;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResponseController extends Controller
{
    protected static $headers = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Method' => 'POST, GET',
        // Accept if request is sent with credential
        'Access-Control-Allow-Credentials' => 'true',
        // Expiry time for cached result
        'Access-Control-Max-Age' => '86400',
        // What type of custom header we allow
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With'
    ];

    public static function send($data=false, $message='', $code=200){
        $data = [
            'error' => $code != 200,
            'message' => $message,
            'data' => $data
        ];

        response()->json($data,$code,static::$headers)->send();
        die;
    }

    public static function badRequest($message = ''){
        self::send(message:$message, code:400);
    }

    public static function unauthorized($message = ''){
        self::send(message:$message, code:401);
    }

    public static function forbidden($message = ''){
        self::send(message:$message, code:403);
    }
}
