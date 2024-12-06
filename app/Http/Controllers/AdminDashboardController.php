<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Render halaman dashboard admin
     */
    public function index() {
        return response()->view('dashboard', [
            'role' => 'admin'
        ]);
    }
}
