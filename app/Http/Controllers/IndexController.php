<?php

namespace App\Http\Controllers;

use App\Mail\SendFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
    public function signinpage()
    {
        return response()->view('signin', [
            'title' => 'Signin | RAIN'
        ]);
    }

    /**
     * Method untuk menampilkan halaman signin admim
     */
    public function signinAdminPage()
    {
        return response()->view('admin.signin', [
            'title' => 'Signin Admin | RAIN'
        ]);
    }

    /**
     * Method untuk menampilkan halaman signup mahasiswa
     */
    public function signupStudentPage()
    {
        return response()->view('student.signup', [
            'title' => 'Signup Student | RAIN'
        ]);
    }

    /**
     * Method untuk menampilkan halaman signup perusahaan
     */
    public function signupCompanyPage()
    {
        return response()->view('company.signup', [
            'title' => 'Signup Company | RAIN'
        ]);
    }

    /**
     * Method untuk menampilkan halaman forget password mahasiswa dan
     * perusahaan
     */
    public function forgetPasswordPage()
    {
        return response()->view('forget-password');
    }

    // handle data feedback dari user
    public function sendFeedback(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'email' => ['required', 'present', 'email:dns'],
            'feedback' => ['required', 'present']
        ]);

        if ($validator->fails()) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Request denied',
                message: $validator->messages(),
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }

        try {
            $mail = (new SendFeedback($request->input('email'), $request->input('feedback')))
                ->onConnection('database')
                ->onQueue('default');

            Mail::to('rainpolibatam@gmail.com')
                ->queue($mail);

            return response()->json($this->setResponse(
                success: true,
                title: 'Berhasil mengirim feedback',
                message: 'Terima kasih atas feedback yang anda berikan kepada website kami',
                icon: asset('storage/svg/success-checkmark.svg')
            ), 200);
        } catch (\Throwable $e) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Request ditolak',
                message: 'Terjadi kesalahaan saat melakukan request',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
        }
    }

    // untuk set response pesan ajax
    private function setResponse(
        bool $success = true,
        string $title = '',
        string $message = '',
        string $type = '',
        string $icon = ''
    ): array {
        return [
            'success' => $success,
            'notification' => [
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'icon' => $icon
            ]
        ];
    }
}
