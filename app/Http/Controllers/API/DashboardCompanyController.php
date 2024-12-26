<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\Vacancy;
use Exception;
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
        $response = [
            'success' => null,
            'notification' => [
                'title' => null,
                'message' => null,
                'icon' => null
            ]
        ];

        try {
            $validated = $request->validate([
                'id_proposal' => ['required', 'integer', 'present', 'min:1'],
                'status' => ['required', 'string', 'present', Rule::in(['waiting', 'approved', 'rejected'])]
            ]);

            $proposal = Proposal::select('proposal_status', 'nim', 'id_proposal', 'interview_date')
                ->with([
                    'student' => function ($query) {
                        $query->select('nim', 'id_user', 'approved_datetime')->with(['account' => function ($query) {
                            $query->select('id_user', 'email');
                        }]);
                    }
                ])
                ->where('id_proposal', $validated['id_proposal'])
                ->first();

            // check apakah $proposal kosong
            if (empty($proposal) === true) {
                $response['success'] = false;
                $response['notification']['title'] = 'Data tidak ditemukan';
                $response['notification']['message'] = 'Tidak dapat melakukan update, data tidak ditemukan';
                $response['notification']['icon'] = asset('storage/svg/failed-x.svg');

                return response()->json($response);
            }

            if ($proposal->proposal_status !== 'approved' && $validated['status'] === 'approved') {
                $proposal->student->approved_datetime = now();
                $proposal->proposal_status = $validated['status'];
                $proposal->interview_status = 'waiting';
                $proposal->final_status = 'waiting';

                $proposal->save();
                $proposal->student->save();

                $response['success'] = true;
                $response['notification']['title'] = 'Status berhasil diperbarui!';
                $response['notification']['message'] = 'Silahkan hubungi kontak pelamar untuk melakukan konfirmasi!';
                $response['notification']['icon'] = asset('storage/svg/success-checkmark.svg');

                // send an email afterward

                return response()->json($response);
            }

            if ($validated['status'] === 'rejected') {
                $proposal->student->approved_datetime = null;
                $proposal->proposal_status = $validated['status'];
                $proposal->interview_status = $validated['status'];
                $proposal->final_status = $validated['status'];
                $proposal->interview_date = null;

                $proposal->student->save();
                $proposal->save();

                $response['success'] = true;
                $response['notification']['title'] = 'Status berhasil diperbarui!';
                $response['notification']['message'] = 'Silahkan hubungi kontak pelamar untuk konfirmasi!';
                $response['notification']['icon'] = asset('storage/svg/success-checkmark.svg');

                // send an email afterward

                return response()->json($response);
            }

            if ($validated['status'] === 'waiting') {
                $proposal->interview_date = null;
                $proposal->proposal_status = $validated['status'];
                $proposal->interview_status = $validated['status'];
                $proposal->final_status = $validated['status'];

                $proposal->save();

                $response['success'] = true;
                $response['notification']['title'] = 'Status berhasil diperbarui!';
                $response['notification']['message'] = 'Silahkan hubungi kontak pelamar untuk konfirmasi!';
                $response['notification']['icon'] = asset('storage/svg/success-checkmark.svg');

                return response()->json($response);
            }

            // send an email afterward

            $response['success'] = true;
            $response['notification']['title'] = 'Status tidak diperbarui!';
            $response['notification']['message'] = 'Tidak ada status yang diperbarui!';
            $response['notification']['icon'] = asset('storage/svg/success-checkmark.svg');

            return response()->json($response);
        } catch (\Throwable $e) {
            $response['success'] = false;
            $response['notification']['message'] = 'Terjadi kesalahaan saat melakukan update';
            $response['notification']['icon'] = asset('storage/svg/failed-x.svg');

            return response()->json($response, 500);
        }
    }

    // method request ubah status wawancara
    public function updateStatusApplicantInterview(Request $request)
    {
        $response = [
            'success' => null,
            'notification' => [
                'title' => null,
                'message' => null,
                'icon' => null
            ]
        ];

        try {
            $validated = $request->validate([
                'id_proposal' => ['required', 'integer', 'present', 'min:1'],
                'status' => ['required', 'string', 'present', Rule::in(['waiting', 'approved', 'rejected'])]
            ]);

            $interview = Proposal::select('proposal_status', 'nim', 'id_proposal', 'interview_date', 'interview_status', 'final_status')
                ->with([
                    'student' => function ($query) {
                        $query->select('nim', 'id_user', 'approved_datetime')->with(['account' => function ($query) {
                            $query->select('id_user', 'email');
                        }]);
                    }
                ])
                ->where('id_proposal', $validated['id_proposal'])
                ->first();

            // check apakah $interview kosong
            if (empty($interview) === true) {
                $response['success'] = false;
                $response['title'] = 'Data tidak ditemukan!';
                $response['message'] = 'Tidak dapat melakukan update, data tidak ditemukan';
                $response['icon'] = asset('storge/svg/failed-x.svg');

                return response()->json($response);
            }

            // check apakah approved_datetime terisi, interview_date terisi, proposal_status adalah approved dan status approved
            if ($interview->student->approved_datetime == true && $interview->interview_date == true && $interview->proposal_status === 'approved' && $validated['status'] === 'approved') {
                $interview->interview_status = $validated['status'];
                $interview->final_status = $validated['status'];
                $interview->save();

                $response['success'] = true;
                $response['notification']['title'] = 'Status berhasil diperbarui!';
                $response['notification']['message'] = 'Silahkan hubungi kontak pelamar untuk melakukan konfirmasi';
                $response['notification']['icon'] = asset('storage/svg/success-checkmark.svg');

                // send an email afterward

                return response()->json($response);
            }

            // check apakah status rejected
            if ($validated['status'] === 'rejected') {
                $interview->student->approved_datetime = null;
                $interview->interview_date = null;
                $interview->interview_status = $validated['status'];
                $interview->proposal_status = $validated['status'];
                $interview->final_status = $validated['status'];

                $interview->save();
                $interview->student->save();

                $response['success'] = true;
                $response['notification']['title'] = 'Status berhasil diperbarui!';
                $response['notification']['message'] = 'Silahkan hubungi kontak pelamar untuk konfirmasi';
                $response['notification']['icon'] = asset('storage/svg/success-checkmark.svg');

                // send an email afterward

                return response()->json($response);
            }

            // check apakah status waiting
            if ($validated['status'] === 'waiting') {
                $interview->interview_date = null;
                $interview->interview_status = $validated['status'];
                $interview->final_status = $validated['status'];

                $interview->save();

                $response['success'] = true;
                $response['notification']['title'] = 'Status berhasil diperbarui!';
                $response['notification']['message'] = 'Silahkan hubungi kontak pelamar untuk konfirmasi!';
                $response['notification']['icon'] = asset('storage/svg/success-checkmark.svg');

                // send an email afterward

                return response()->json($response);
            }

            $response['success'] = true;
            $response['notification']['title'] = 'Status tidak diiperbarui!';
            $response['notification']['message'] = 'Tidak ada status yang di update';
            $response['notification']['icon'] = asset('storage/svg/success-checkmark.svg');

            return response()->json($response);
        } catch (\Throwable $e) {
            $response['success'] = false;
            $response['notification']['message'] = 'Terjadi keesalahan saat melakukan update';
            $response['notification']['icon'] = asset('storage/svg/failed-x.svg');

            return response()->json($response, 500);
        }
    }

    // method request atur tanggal interview
    public function setInterviewDate(Request $request)
    {
        $response = [
            'success' => null,
            'notification' => [
                'message' => null,
                'type' => null
            ]
        ];

        $validator = Validator::make($request->input(), [
            'interview_date' => ['required', 'present', 'date_format:Y-m-d\TH:i', 'after:tomorrow'],
            'id_proposal' => ['required', 'present', 'integer', 'min:1']
        ]);

        // check apakah validasi gagal
        if ($validator->fails()) {
            $response['success'] = false;
            $response['notification']['message'] = "Format tanggal dan waktu salah, harap coba lagi!";
            $response['notification']['type'] = 'danger';

            return response()->json($response);
        }

        $proposal = Proposal::select('interview_date', 'proposal_status', 'interview_status')
            ->where('id_proposal', $validator->getValue('id_proposal'))
            ->first();

        // check apakah $proposal kosong
        if (empty($proposal) === true) {
            $response['success'] = false;
            $response['notification']['message'] = 'Gagal atur tanggal, data tidak ditemukan';
            $response['notification']['type'] = 'danger';

            return response()->json($response);
        }

        // check apakah status proposal bukan approved
        if ($proposal->proposal_status !== 'approved') {
            $response['success'] = false;
            $response['notification']['message'] = 'Gagal atur tanggal, status lamaran harus diterima';
            $response['notification']['type'] = 'danger';

            return response()->json($response);
        }

        // check apakah status interview status adalah rejected atau approved
        if (in_array($proposal->interview_status, ['rejected', 'approved'])) {
            $response['success'] = false;
            $response['notification']['message'] = 'Gagal atur tanggal, status wawancara harus menunggu';
            $response['notification']['type'] = 'danger';

            return response()->json($response);
        }

        $proposal->interview_date = date('Y-m-d H:i:s', strtotime($validator->getValue('interview_date')));
        $proposal->id_proposal = $validator->getValue('id_proposal');
        $proposal->save();

        $response['success'] = true;
        $response['notification']['message'] = 'Berhasil atur tanggal dan waktu wawancara';
        $response['notification']['type'] = 'primary';

        return response()->json($response);
    }
}
