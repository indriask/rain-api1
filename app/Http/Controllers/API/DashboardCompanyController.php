<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardCompanyController extends Controller
{
    /**
     * 
     * Method untuk mem-proses logika tambah lowongan
     */
    public function addVacancy(Request $request)
    {
        try {
            $validated = $request->validate([
                'salary' => ['required', 'present', 'integer', 'max:10000000'],
                'title' => ['required', 'present', 'string', 'max:100'],
                'major' => ['required', 'present', 'string', Rule::in(['teknik informatika', 'teknik mesin', 'teknik elektro', 'manajemen bisnis'])],
                'location' => ['required', 'present', 'string', 'max:60'],
                'date_created' => ['required', 'present', 'date'],
                'date_ended' => ['required', 'present', 'date'],
                'time_type' => ['required', ' present', 'string', 'max:10', Rule::in(['full time', 'part time'])],
                'type' => ['required', ' present', 'string', 'max:10', Rule::in(['online', 'offline'])],
                'duration' => ['required', ' present', 'integer', 'max:12'],
                'quota' => ['required', 'present', 'integer', 'min:1', 'max:50'],
                'description' => ['required', 'present', 'string', 'max:1000']
            ]);

            $validated['applied'] = 0;
            $validated['nib'] = auth('web')->user()->nib;
            $newData = Vacancy::create($validated);

            $findData = Vacancy::with('company.profile')->find($newData->id_vacancy);

            response()->json([
                'success' => true,
                'newData' => $findData,
                'notification' => [
                    'message' => 'Lowongan anda berhasil di ekspos!',
                    'icon' => 'http://localhost:8000/storage/svg/success-checkmark.svg'
                ]
            ])->send();
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'notification' => [
                    'message' => 'Lowongan anda gagal di ekspos!',
                    'icon' => 'http://localhost:8000/storage/svg/failed-x.svg'
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
                'major' => ['required', 'present', 'string', Rule::in(['teknik informatika', 'teknik mesin', 'teknik elektro', 'manajemen bisnis'])],
                'location' => ['required', 'present', 'string', 'max:60'],
                'date_created' => ['required', 'present', 'date'],
                'date_ended' => ['required', 'present', 'date'],
                'time_type' => ['required', ' present', 'string', 'max:10', Rule::in(['full time', 'part time'])],
                'type' => ['required', ' present', 'string', 'max:10', Rule::in(['online', 'offline'])],
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
                    'icon' => 'http://localhost:8000/storage/svg/success-checkmark.svg'
                ]
            ])->send();
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'notification' => [
                    'message' => 'Lowongan anda gagal di edit!',
                    'icon' => 'http://localhost:8000/storage/svg/failed-x.svg',
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
                'nib' => ['required', 'present', 'string'],
                'id_vacancy' => ['required', 'present', 'integer'],
            ]);

            Vacancy::where('id_vacancy', $validated['id_vacancy'])
                ->where('nib', $validated['nib'])
                ->delete();

            return response()->json([
                'success' => true,
                'notification' => [
                    'message' => 'Lowongan anda berhasil di hapus!',
                    'icon' => 'http://localhost:8000/storage/svg/success-checkmark.svg',
                ],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'notification' => [
                    'message' => 'Lowongan anda gagal di hapus!',
                    'icon' => 'http://localhost:8000/storage/svg/failed-x.svg',
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
