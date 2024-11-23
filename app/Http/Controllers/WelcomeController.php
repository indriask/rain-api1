<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    public function welcome()
    {
        return response()->view('index', [
            'title' => 'RAIN, Your beloved vacancy website provider'
        ]);
    }
}
