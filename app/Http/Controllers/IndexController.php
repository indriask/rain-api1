<?php

namespace App\Http\Controllers;


class IndexController extends Controller
{
    /**
     * Method untuk menampilkan halaman branding RAIN
     */
    public function index()
    {
        return response()->view('index', [
            'title' => 'RAIN, Your beloved vacancy website provider'
        ]);
    }

    /**
     * Method untuk menampilkan halaman signin mahasiswa dan perusahaan
     */
    public function signinpage() {
        return response()->view('signin', [
            'title' => 'Signin | RAIN'
        ]);
    }

    /**
     * Method untuk menampilkan halaman signin admim
     */
    public function signinAdminPage() {
        return response()->view('admin.signin', [
            'title' => 'Signin Admin | RAIN'
        ]);
    }

    /**
     * Method untuk menampilkan halaman signup mahasiswa
     */
    public function signupStudentPage() {
        return response()->view('student.signup', [
            'title' => 'Signup Student | RAIN'
        ]);
    }

    /**
     * Method untuk menampilkan halaman signup perusahaan
     */
    public function signupCompanyPage() {
        return response()->view('company.signup', [
            'title' => 'Signup Company | RAIN'
        ]);
    }
    
    /**
     * Method untuk menampilkan halaman forget password mahasiswa dan
     * perusahaan
     */
    public function forgetPasswordPage() {
        return response()->view('forget-password');
    }
}
