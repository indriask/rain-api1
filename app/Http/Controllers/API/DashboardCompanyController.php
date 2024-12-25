<<<<<<< HEAD
S 
=======
<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\Proposal;
use App\Models\Vacancy;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mockery\CountValidator\Exact;

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
            'description' => ['present', 'string', 'max:1000']
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
                    'message' => 'Terjadi kesalahaan saat tambah lowongan!',
                    'icon' => asset('storage/svg/failed-x.svg')
                ],
            ], 500);
        }
    }

    /**
     * Method untuk mem-proses logika edit lowongan
     */
    public function editVacancy(Request $request)
    {
        $validator = Validator::make($request->input(), [
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
            'description' => ['present', 'string', 'max:1000'],
            'id_vacancy' => ['required', 'present', 'integer'],
            'nib' => ['required', 'present', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['validation_error' => $validator->errors()]);
        }

        try {
            Vacancy::where('id_vacancy', $validator->getValue('id_vacancy'))
                ->where('nib', $validator->getValue('nib'))
                ->update($request->except('id_vacancy', 'nib'));

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
                    'message' => 'Terjadi kesalahaan saat edit lowongan!',
                    'icon' => asset('storage/svg/failed-x.svg'),
                ],
            ], 500);
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
                    'message' => 'Terjadi kesalahaan saat menghapus lowongan!',
                    'icon' => asset('storage/svg/failed-x.svg')
                ],
            ], 500);
        }
    }

    /**
     * Method untuk mem-proses logika penghapusan lamaran
     */
    public function deleteApplicant(Request $request)
    {
        try {
            return throw new Exception();
            $validated = $request->validate(['id_proposal' => ['required', 'integer', 'present', 'min:1']]);
            $proposal = Proposal::select('id_proposal')->where('id_proposal', $validated['id_proposal'])
                ->whereHas('vacancy', function ($query) {
                    $query->where('nib', auth('web')->user()->company->nib);
                })
                ->first();

            if (empty($proposal)) {
                return response()->json([
                    'error' => true,
                    'notification' => [
                        'message' => 'Data tidak ditemukan',
                        'icon' => asset('storage/svg/failed-x.svg')
                    ]
                ]);
            }

            $proposal->delete();
            return response()->json([
                'success' => true,
                'notification' => [
                    'message' => 'Data berhasil di hapus!',
                    'icon' => asset('storage/svg/success-checkmark.svg')
                ]
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'notification' => [
                    'message' => 'Terjadi kesalahan saat penghapusan data',
                    'icon' => asset('storage/svg/failed-x.svg')
                ]
            ], 500);
        }
    }

    // method request ubah status lamaran
    public function updateStatusApplicantProposal(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_proposal' => ['required', 'integer', 'present', 'min:1'],
                'status' => ['required', 'string', 'present', Rule::in(['waiting', 'approved', 'rejected'])]
            ]);

            $proposal = Proposal::select('proposal_status', 'nim', 'id_proposal')
                ->with([
                    'student' => function ($query) {
                        $query->select('nim', 'id_user', 'approved_datetime')->with(['account' => function ($query) {
                            $query->select('id_user', 'email');
                        }]);
                    }
                ])
                ->where('id_proposal', $validated['id_proposal'])
                ->first();

            if (empty($proposal) === true) {
                return response()->json([
                    'error' => true,
                    'notification' => [
                        'title' => 'Data tidak ditemukan!',
                        'message' => 'Tidak dapat melakukan update, data tidak ditemukan',
                        'icon' => asset('storage/svg/failed-x.svg')
                    ]
                ]);
            }

            if (empty($proposal->student->approved_datetime) === true && $validated['status'] === 'approved') {
                $proposal->student->approved_datetime = now();
                $proposal->proposal_status = 'approved';
                $proposal->save();
                $proposal->student->save();

                return response()->json([
                    'success' => true,
                    'notification' => [
                        'title' => 'Status berhasil diperbarui!',
                        'message' => 'Silahkan hubungi kontak pelamar untuk melakukan konfirmasi!',
                        'icon' => asset('storage/svg/success-checkmark.svg')
                    ]
                ]);
            }

            if ($validated['status'] === 'rejected' || $validated['status'] === 'waiting') {
                $proposal->student->approved_datetime = null;
                $proposal->proposal_status = $validated['status'];
                $proposal->save();
                $proposal->student->save();

                return response()->json([
                    'success' => true,
                    'notification' => [
                        'title' => 'Status berhasil diperbarui!',
                        'message' => 'Silahkan menghubungi kontak pelamar untuk konfirmasi!',
                        'icon' => asset('storage/svg/success-checkmark.svg')
                    ]
                ]);
            }

            // send an email afterward

            return response()->json([
                'success' => true,
                'notification' => [
                    'title' => 'Status tidak diperbarui!',
                    'message' => 'Tidak ada status yang di update',
                    'icon' => asset('storage/svg/success-checkmark.svg')
                ]
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'notification' => [
                    'message' => 'Terjadi kesalahan saat melakukan update',
                    'icon' => asset('storage/svg/failed-x.svg')
                ]
            ], 500);
        }
    }

    // method request atur tanggal interview
    public function setInterviewDate(Request $request) {
        $validator = Validator::make($request->input(), [
            'interview_date' => ['required', 'present', 'date_format:Y-m-d\TH:i', 'after:tomorrow']
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => true,
                'notification' => [
                    'message' => $validator->errors(),
                    'type' => 'danger'
                ]
            ]);
        }

        // check proposal_status = true
        // check interview_status = null
        $proposal = Proposal::select('interview_date')
            ->whereNotNull('proposal_status')
            ->where('interview_status', null);

        return response()->json('success');
    }
}
>>>>>>> 1cadbacd22249cf0af8a2d28ff57928824d24256
