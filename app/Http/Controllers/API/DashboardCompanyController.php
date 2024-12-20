<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DashboardCompanyController extends Controller
{
    /**
     * 
     * Method untuk mem-proses logika tambah lowongan
     */
    public function addVacancy(Request $request)
    {
        $validated = Validator::make($request->input(), [
            'salary' => ['required', 'present', 'integer', 'max:10000000', 'min: 100000'],
            'title' => ['required', 'present', 'string', 'max:100'],
            'id_major' => ['required', 'present', 'string', Rule::in(['1', '2', '3', '4'])],
            'location' => ['required', 'present', 'string', 'max:60'],
            'date_created' => ['required', 'present', 'date'],
            'date_ended' => ['nullable', 'present', 'date'],
            'time_type' => ['required', 'present', 'string', 'max:10', Rule::in(['full time', 'part time'])],
            'type' => ['required', 'present', 'string', 'max:10', Rule::in(['online', 'offline', 'hybrid'])],
            'duration' => ['required', ' present', 'integer', 'max:12'],
            'quota' => ['required', 'present', 'integer', 'min:1', 'max:50'],
            'description' => ['required', 'present', 'string', 'max:1000']
        ]);

        if ($validated->fails()) {
            return response()->json(['validation_error' => $validated->errors()]);
        }

        try {
            $validated->setValue('applied', 0);
            $validated->setValue('nib', auth('web')->user()->company->nib);
            $dateCreated = $validated->getValue('date_created');
            $dateEnded = $validated->getValue('date_ended');

            /**
             * check apakah tanggal dibuka lebih besar dari tanggal ditutup dan
             * tanggal ditutup lebih kecil dari tanggal dibuka
             */
            if ($dateCreated > $dateEnded || $dateEnded < $dateCreated) {
                $timestamp = strtotime($dateCreated);

                // set tanggal ditutup menjadi 3 hari berdasarkan tanggal dibuka
                $validated->setValue('date_ended', date('Y-m-d', $timestamp + (86400 * 3)));
            }

            if ($validated->getValue('date_ended') === null) {
                $validated->setValue('date_ended', date('Y-m-d', time() + (86400 * 3)));
            }

            Vacancy::create($validated->getData());

            response()->json([
                'success' => true,
                'notification' => [
                    'message' => 'Lowongan anda berhasil di ekspos!',
                    'icon' => asset('storage/svg/success-checkmark.svg')
                ]
            ])->send();
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'notification' => [
                    'message' => 'Lowongan anda gagal di ekspos!',
                    'icon' => asset('storage/svg/failed-x.svg')
                ],
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Method untuk mem-proses logika edit lowongan
     */
    public function editVacancy(Request $request)
    {
        try {
            $validated = $request->validate([
                'salary' => ['required', 'present', 'integer', 'max:10000000'],
                'title' => ['required', 'present', 'string', 'max:100'],
                'id_major' => ['required', 'present', 'string', Rule::in(['1', '2', '3', '4'])],
                'location' => ['required', 'present', 'string', 'max:60'],
                'date_created' => ['required', 'present', 'date'],
                'date_ended' => ['required', 'present', 'date'],
                'time_type' => ['required', ' present', 'string', 'max:10', Rule::in(['full time', 'part time'])],
                'type' => ['required', ' present', 'string', 'max:10', Rule::in(['online', 'offline', 'hybrid'])],
                'duration' => ['required', ' present', 'integer', 'max:12'],
                'quota' => ['required', 'present', 'integer', 'min:1', 'max:50'],
                'description' => ['required', 'present', 'string', 'max:1000'],
                'id_vacancy' => ['required', 'present', 'integer'],
                'nib' => ['required', 'present', 'string'],
            ]);

            $validated['applied'] = 0;
            Vacancy::where('id_vacancy', $validated['id_vacancy'])
                ->where('nib', $validated['nib'])
                ->update($validated);

            response()->json([
                'success' => true,
                'notification' => [
                    'message' => 'Lowongan anda berhasil di edit!',
                    'icon' => asset('storage/svg/success-checkmark.svg')
                ]
            ])->send();
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'notification' => [
                    'message' => 'Lowongan anda gagal di edit!',
                    'icon' => asset('storage/svg/failed-x.svg'),
                ],
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Method untuk mem-proses logika penghapusan lowongan
     */
    public function deleteVacancy(Request $request)
    {
        try {
            $validated = $request->validate([
                'nib' => ['required', 'present', 'string', 'min:9', 'max:10'],
                'id_vacancy' => ['required', 'present', 'integer'],
            ]);

            Vacancy::where('id_vacancy', $validated['id_vacancy'])
                ->where('nib', $validated['nib'])
                ->delete();

            return response()->json([
                'success' => true,
                'notification' => [
                    'message' => 'Lowongan anda berhasil di hapus!',
                    'icon' => asset('storage/svg/success-checkmark.svg')
                ],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'notification' => [
                    'message' => 'Lowongan anda gagal di hapus!',
                    'icon' => asset('storage/svg/failed-x.svg')
                ],
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Method untuk mem-proses logika penghapusan lamaran
     */
    public function deleteApplicant(Request $request) {}

    /**
     * Method untuk mem-proses logika perbarui status pelamar
     */
    public function updateStatusApplicant(Request $request) {}
}
