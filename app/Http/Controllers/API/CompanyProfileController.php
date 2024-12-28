<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Profile;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyProfileController extends Controller
{
    // method untuk edit profile di database
    public function editProfile(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'fullname' => ['required', 'string', 'max:200', 'present'],
            'photo-profile' => ['nullable', 'file', 'mimes:png,jpeg,jpg'],
            'old-photo-profile' => ['required', 'string', 'present'],
            'type' => ['nullable', 'string', 'present', 'max:200'],
            'location' => ['nullable', 'string', 'present', 'max:200'],
            'city' => ['nullable', 'string', 'present', 'max:200'],
            'postal-code' => ['nullable', 'numeric', 'present', 'max_digits:6', 'min_digits:6'],
            'founded-date' => ['nullable', 'date_format:Y-m-d', 'present'],
            'business-fields' => ['nullable', 'string', 'present', 'max:200'],
            'phone-number' => ['nullable', 'numeric', 'present', 'min_digits:1', 'max_digits:14'],
            'description' => ['nullable', 'string', 'present', 'max:1500']
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        try {
            $user = auth('web')->user()->company;

            if (empty($user)) {
                $response = $this->setResponse(
                    success: false,
                    message: 'Gagal melakukan update, data tidak ditemukan',
                    icon: asset('storage/svg/failed-x.svg')
                );

                return response()->json($response);
            }

            if ($validator->getValue('nib') !== (string)$user->nib) {
                $isExist = Company::where('nib', $validator->getValue('nib'))
                    ->first();

                if ($isExist) {
                    $respone = $this->setResponse(
                        success: false,
                        message: 'NIB sudah terdaftar pada system',
                        icon: asset('storage/svg/failed-x.svg')
                    );

                    return response()->json($respone);
                }
            }

            [$firstName, $lastName] = explode(' ', $validator->getValue('fullname'), 2);
            $photoProfile = null;
            $hasFile = $request->hasFile('photo-profile');

            // buat photo profile baru jika photo-profile ada
            if($hasFile) {
                $file = $request->file('photo-profile');

                if($file->getSize() > 2000000) {
                    $response = $this->setResponse(
                        success: false,
                        message: 'Ukuran gambar profile harus dibawah 2MB',
                        icon: asset('storage/svg/failed-x.svg')
                    );

                    return response()->json($response);
                }

                $newFileName = time() . '_' . $file->getClientOriginalName();
            } else {
                $photoProfile = $validator->getValue('old-photo-profile');
            }

            Company::where('nib', $user->nib)
                ->update([
                    'type' => $validator->getValue('type') ?? null,
                    'founded_date' => $validator->getValue('founded-date') ?? null,
                    'business_fields' => $validator->getValue('business-fields') ?? null,
                ]);


            Profile::where('id_profile', $user->id_profile)
                ->update([
                    'first_name' => $firstName ?? 'Username',
                    'last_name' => $lastName ?? null,
                    'photo_profile' => ($hasFile) ? $file->storeAs('profile', $newFileName, 'public') : $photoProfile,
                    'location' => $validator->getValue('location') ?? null,
                    'city' => $validator->getValue('city') ?? null,
                    'postal_code' => $validator->getValue('postal-code') ?? null,
                    'phone_number' => $validator->getValue('phone-number') ?? null,
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
                message: 'Profil gagal diperbarui!',
                icon: asset('storage/svg/failed-x.svg')
            );

            // return response()->json($response, 500);
            return response()->json($e->getMessage());
        }
    }

    // method untuk menghasilkan response request
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
