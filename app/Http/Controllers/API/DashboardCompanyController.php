<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardCompanyController extends Controller
{
    /**
     * Method untuk mem-proses logika tambah lowongan
     */
    public function addVacancy(Request $request) {
        try {
            $validated = $request->validate([
                'salary' => ['required', 'present', 'integer', 'max:10000000'],
                'title' => ['required', 'present', 'string', 'max:100'],
                'major' => ['required', 'present', 'string', Rule::in(['Teknik Informatika', 'Teknik Mesin', 'Teknik Elektro', 'Manajemen Bisnis'])],
                'location' => ['required', 'present', 'string', 'max:60'],
                'date_created' => ['required', 'present', 'date'],
                'date_ended' => ['required', 'present', 'date'],
                'time_type' => ['required',' present', 'string', 'max:10', Rule::in(['Full time', 'Part time'])],
                'type' => ['required',' present', 'string', 'max:10', Rule::in(['Online', 'Offline'])],
                'duration' => ['required',' present', 'integer', 'max:12'],
                'quota' => ['required', 'present', 'integer', 'min:1', 'max:50'],
                'description' => ['required', 'present', 'string', 'max:1000']
            ]);

            $validated['applied'] = 0;
            $validated['nib'] = auth('web')->user()->company->nib;
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
        } catch(\Throwable $e) {
            return response()->json([
                'success' => false,
                'notification' => [
                    'message' => 'Lowongan anda gagal di ekspos!',
                    'icon' => 'http://localhost:8000/storage/svg/failed-x.svg'
                ]
            ]);
        }
    }

    /**
     * Method untuk mem-proses logika edit lowongan
     */
    public function editVacancy(Request $request) {}

    /**
     * Method untuk mem-proses logika penghapusan lamaran
     */
    public function deleteApplicant(Request $request) {}

    /**
     * Method untuk mem-proses logika perbarui status pelamar
     */
    public function updateStatusApplicant(Request $request) {}
}
