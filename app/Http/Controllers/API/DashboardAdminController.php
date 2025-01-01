<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Profile;
use App\Models\User;
use App\Models\Vacancy;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class DashboardAdminController extends Controller
{
    // Method untuk mem-proses logika delete lowongan
    public function deleteVacancy(Request $request) {
        try {
            $validated = $request->validate([
                'id_vacancy' => ['required', 'present', 'integer', 'min:1', 'exists:vacancy,id_vacancy']
            ]);

            Vacancy::find($validated['id_vacancy'])->delete();

            $response = $this->setResponse(
                success: false,
                message: 'Berhasil hapus lowongan',
                icon: asset('storage/svg/success-checkmark.svg')
            );

            return response()->json($response, 200);
        } catch(\Throwable $e) {
            $response = $this->setResponse(
                success: false,
                title: 'Gagal hapus lowongan',
                message: 'Terjadi kesalhaan saat penghapusan data, harap check input anda',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response()->json($response, 500);
        }
    }

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
    public function editProfile(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'fullname' => ['required', 'string', 'max:200', 'present'],
            'photo_profile' => ['nullable', 'file', 'mimes:png,jpeg,jpg'],
            'old_photo_profile' => ['required', 'string', 'present'],
            'institute' => ['nullable', 'string', 'present', 'max:200'],
            'location' => ['nullable', 'string', 'present', 'max:200'],
            'city' => ['nullable', 'string', 'present', 'max:200'],
            'postal_code' => ['nullable', 'numeric', 'present', 'max_digits:6', 'min_digits:6'],
            'phone_number' => ['nullable', 'numeric', 'present', 'min_digits:1', 'max_digits:14'],
            'description' => ['nullable', 'string', 'present', 'max:1500']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {
            $user = auth('web')->user()->admin;

            if (empty($user)) {
                $response = $this->setResponse(
                    success: false,
                    title: 'Data tidak ada',
                    message: 'Gagal melakukan update profile, data tidak ada',
                    icon: asset('storage/svg/failed-x.svg')
                );

                return response()->json($response);
            }

            $fullName = explode(' ', $validator->getValue('fullname'), 2);
            $firstName = $fullName[0] ?? 'Username';
            $lastName = $fullName[1] ?? null;

            $photoProfile = null;
            $hasFile = $request->hasFile('photo_profile');

            // buat photo profile baru jika photo-profile ada
            if ($hasFile) {
                $file = $request->file('photo_profile');

                if ($file->getSize() > 2000000) {
                    $response = $this->setResponse(
                        success: false,
                        title: 'Ukuran profile',
                        message: 'Ukuran gambar profile harus dibawah 2MB',
                        icon: asset('storage/svg/failed-x.svg')
                    );

                    return response()->json($response);
                }

                $newFileName = time() . '_' . $file->getClientOriginalName();
            } else {
                $photoProfile = $validator->getValue('old_photo_profile');
            }

            Admin::where('id_admin', $user->id_admin)
                ->update([
                    'institute' => $validator->getValue('institute') ?? null,
                ]);

            Profile::where('id_profile', $user->id_profile)
                ->update([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'photo_profile' => ($hasFile) ? $file->storeAs('profile', $newFileName, 'public') : $photoProfile,
                    'location' => $validator->getValue('location') ?? null,
                    'city' => $validator->getValue('city') ?? null,
                    'postal_code' => $validator->getValue('postal_code') ?? null,
                    'phone_number' => $validator->getValue('phone_number') ?? null,
                    'description' => $validator->getValue('description') ?? null
                ]);

            $response = $this->setResponse(
                success: true,
                message: 'Profile berhasil diperbarui!',
                icon: asset('storage/svg/success-checkmark.svg'),
            );

            return response()->json($response, 200);
        } catch (\Throwable $e) {
            $response = $this->setResponse(
                success: false,
                title: 'Gagal request update',
                message: 'Terjadi kesalhaan saat melakukan request profile, silahkan coba lagi',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response()->json($response, 500);
        }
    }

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
