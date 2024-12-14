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
                'salary' => ['required', 'present', 'string'],
                'title' => ['required', 'present', 'string', 'max:100'],
                'major' => ['required', 'present', 'string', Rule::in(['Teknik Informatika', 'Teknik Mesin', 'Teknik Elektro', 'Manajemen Bisnis'])],
                'location' => ['required', 'present', 'string', 'max:60'],
                'date_created' => ['required', 'present', 'date'],
                'date_ended' => ['required', 'present', 'date'],
                'time_type' => ['required',' present', 'string', 'max:10', Rule::in(['Full time', 'Part time'])],
                'type' => ['required',' present', 'string', 'max:10', Rule::in(['Online', 'Offline'])],
                'duration' => ['required',' present', 'integer', 'max:12'],
                'quota' => ['required', 'present', 'integer', 'min:1', 'max:50'],
                'description' => ['required', 'present', 'string', 'max:1000'],
                'company_logo' => ['file', 'mimes:jpg,jpeg,png']
            ]);

            $validated['applied'] = 0;
            $validated['nib'] = auth('web')->user()->company->nib;
            // hapus attribute status
            $validated['status'] = 'verified';

            if($request->has('company_logo')) {
                $file = $request->file('company_logo');

                if($file->getSize() > 2000000) {
                    throw new \Exception("Ukuran file harus dibawah 2mb");
                }
            }

            Vacancy::create($validated);

            return response()->json(['berhasil derr']);
        } catch(\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
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
