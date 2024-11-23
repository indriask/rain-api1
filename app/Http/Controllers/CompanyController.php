<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Render profile page for company
    public function index() {
        return response()->view('company.profile');
    }
}
