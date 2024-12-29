<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exact;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class DashboardAdminController extends Controller
{
    // Method untuk mem-proses logika delete lowongan
    public function deleteVacancy(Request $request) {}

    // Method untuk mem-proses logika kelola user mahasiswa
    public function manageUserStudent(Request $request) {}

    // Method untuk mem-proses logika kelola user perusahaan
    public function manageUserVacancy(Request $request) {}

    // method untuk menghapus akun user secara permanen
    public function deleteUser(Request $request)
    {
        // return response()->json($request->input());
        try {
            $validated = $request->validate([
                'id_user' => ['required', 'present', 'integer', 'exists:users,id_user']
            ]);

            User::find($validated['id_user'])->delete();
            $response = $this->setResponse(
                success: true,
                message: 'Berhasil hapus akun user',
                icon: asset('storage/svg/success-checkmark.svg')
            );

            return response()->json($response);
        } catch (\Throwable $e) {
            $response = $this->setResponse(
                success: false,
                message: 'Terjadi kesalahan saat melakukan request, silahkan coba lagi',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response()->json($response, 500);
        }
    }

    // method untuk verifikasi akun perusahaan
    public function verifyCompany(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_user' => ['required', 'present', 'integer', 'exists:users,id_user']
            ]);

            $company = Company::where('id_user', $validated['id_user'])->update([
                'status_verified_at' => now()
            ]);

            $response = $this->setResponse(
                success: true,
                message: 'Berhasil verifikasi akun perusahaan',
                icon: asset('storage/svg/success-checkmark.svg')
            );

            return response()->json($response);
        } catch (\Throwable $e) {
            $response = $this->setResponse(
                success: false,
                message: 'Terjadi kesahalaan saat melakukan verifikasi',
                icon: asset('storage/svg/failed-x.svg')
            );

            // return response()->json($response);
            return response()->json($e->getMessage(), 500);
        }

        return response()->json([
            "message" => "Akun berhasil diverifikasi",
            "icon" => "svg/success-checkmark.svg"
        ]);
    }

    // method untuk proses edit data profile
    public function editProfile(Request $request) {}

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
