<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessEmailSending;
use App\Mail\Interview\ApprovedInterview;
use App\Mail\Interview\RejectedInterview;
use App\Mail\Interview\WaitingInterview;
use App\Mail\Proposal\ApprovedProposal;
use App\Mail\Proposal\RejectedProposal;
use App\Mail\Proposal\WaitingProposal;
use App\Models\Proposal;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
            'description' => ['nullable', 'string', 'present']
        ]);

        if ($validated->fails()) {
            return response()->json(['validation_error' => $validated->errors()]);
        }

        try {
            $validated->setValue('applied', 0);
            $validated->setValue('nib', (string) auth('web')->user()->company->nib);
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

            $response = $this->setResponse(
                success: true,
                message: 'Lowongan anda berhasil di ekspos!',
                icon: asset('storage/svg/success-checkmark.svg')
            );

            return response()->json($response);
        } catch (\Throwable $e) {
            $response = $this->setResponse(
                success: false,
                message: 'Terjadi kesalahaan saat tambah lowongan!',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response()->json($response, 500);
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
            'description' => ['nullable', 'present', 'string'],
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

            return response()->json($this->setResponse(
                success: true,
                message: 'Lowongan anda berhasil di edit!',
                icon: asset('storage/svg/success-checkmark.svg')
            ), 200);
        } catch (\Throwable $e) {
            return response()->json($this->setResponse(
                success: false,
                title: 'Request dihentikan',
                message: 'Terjadi kesalhaan saat melakukan request edit lowongan',
                icon: asset('storage/svg/failed-x.svg')
            ), 500);
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

            $response = $this->setResponse(
                success: true,
                message: 'Lowongan anda berhasil di hapus!',
                icon: asset('storage/svg/success-checkmark.svg')
            );

            return response()->json($response);
        } catch (\Throwable $e) {
            $response = $this->setResponse(
                success: false,
                message: 'Terjadi kesalahan saat menghapus lowongan',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response()->json($response, 500);
        }
    }

    /**
     * Method untuk mem-proses logika penghapusan lamaran
     */
    public function deleteApplicant(Request $request)
    {
        try {
            $validated = $request->validate(['id_proposal' => ['required', 'integer', 'present', 'min:1']]);
            $proposal = Proposal::select('id_proposal', 'id_vacancy', 'resume')->where('id_proposal', $validated['id_proposal'])
                ->whereHas('vacancy', function ($query) {
                    $query->where('nib', auth('web')->user()->company->nib);
                })
                ->first();

            if (empty($proposal)) {
                $response = $this->setResponse(
                    success: false,
                    message: 'Data tidak ditemukan',
                    icon: asset('storage/svg/failed-x.svg')
                );

                return response()->json($response);
            }

            $idVacancy = $proposal->id_vacancy;
            $resume = storage_path('app/' . $proposal->resume);
            $proposal->delete();

            $vacancy = Vacancy::where('id_vacancy', $idVacancy)->first();
            $vacancy->applied -= 1;
            $vacancy->save();

            if (file_exists($resume)) {
                File::deleteDirectory($resume);
            }

            $response = $this->setResponse(
                success: true,
                message: 'Data berhasil di hapus!',
                icon: asset('storage/svg/success-checkmark.svg')
            );

            return response()->json($response);
        } catch (\Throwable $e) {
            $resposne = $this->setResponse(
                success: false,
                title: 'Reqeust error',
                message: 'Terjadi kesalahan saat penghapusan data',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response()->json($resposne, 500);
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

            $proposal = Proposal::select('proposal_status', 'nim', 'id_proposal', 'interview_date', 'id_vacancy')
                ->with([
                    'student' => function ($query) {
                        $query->select('nim', 'id_user', 'approved_datetime', 'id_profile')->with(['account' => function ($query) {
                            $query->select('id_user', 'email');
                        }]);
                    },
                    'student.profile' => function ($query) {
                        $query->select('id_profile', 'first_name', 'last_name');
                    },
                    'vacancy' => function ($query) {
                        $query->select('id_vacancy', 'nib', 'title')->with(['company' => function ($query) {
                            $query->select('nib', 'id_profile')->with(['profile' => function ($query) {
                                $query->select('id_profile', 'first_name', 'last_name');
                            }]);
                        }]);
                    },
                ])
                ->where('id_proposal', $validated['id_proposal'])
                ->first();

            // check apakah $proposal kosong
            if (empty($proposal) === true) {
                $response = $this->setResponse(
                    success: false,
                    title: "Data tidak ditemukan",
                    message: "Tidak dapat melakukan update, data tidak ditemukan",
                    icon: asset('storage/svg/failed-x.svg')
                );

                return response()->json($response);
            }

            if ($validated['status'] === 'approved') {
                $proposal->student->approved_datetime = now();
                $proposal->proposal_status = $validated['status'];
                $proposal->interview_status = 'waiting';
                $proposal->final_status = 'waiting';

                $proposal->save();
                $proposal->student->save();

                $response = $this->setResponse(
                    success: true,
                    title: 'Status berhasil diperbarui!',
                    message: 'Silahkan hubungi kontak pelamar untuk melakukan konfirmasi',
                    icon: asset('storage/svg/success-checkmark.svg')
                );

                // send an email afterward
                $company = auth('web')->user()->load('company.profile');
                $companyFullName = ($company->company->profile->first_name ?? 'Username') . ' ' . $company->company->profile->last_name ?? '';
                $studentFullName = ($proposal->student->profile->first_name ?? 'Username') . ' ' . $proposal->student->profile->last_name ?? '';
                $vacancyTitle = $proposal->vacancy->title;

                // Mail::to($proposal->student->account)->send(new ApprovedProposal($companyFullName, $studentFullName, $vacancyTitle));
                $mail = (new ApprovedProposal($companyFullName, $studentFullName, $vacancyTitle))
                    ->onConnection('database')
                    ->onQueue('default');

                Mail::to($proposal->student->account)->queue($mail);

                return response()->json($response);
            }

            if ($validated['status'] === 'rejected') {
                $proposal->proposal_status = $validated['status'];
                $proposal->interview_status = $validated['status'];
                $proposal->final_status = $validated['status'];
                $proposal->interview_date = null;
                $proposal->student->approved_datetime = null;

                $proposal->student->save();
                $proposal->save();

                $response = $this->setResponse(
                    success: true,
                    title: 'Status berhasil diperbarui!',
                    message: 'Silahkan hubungi kontak pelamar untuk konfirmas!',
                    icon: asset('storage/svg/success-checkmark.svg')
                );
                // send an email afterward
                $company = auth('web')->user()->load('company.profile');
                $companyFullName = ($company->company->profile->first_name ?? 'Username') . ' ' . $company->company->profile->last_name ?? '';
                $studentFullName = ($proposal->student->profile->first_name ?? 'Username') . ' ' . $proposal->student->profile->last_name ?? '';
                $vacancyTitle = $proposal->vacancy->title;

                $mail = (new RejectedProposal($companyFullName, $studentFullName, $vacancyTitle))
                    ->onConnection('database')
                    ->onQueue('default');
                Mail::to($proposal->student->account)->queue($mail);

                return response()->json($response);
            }

            if ($validated['status'] === 'waiting') {
                $proposal->interview_date = null;
                $proposal->proposal_status = $validated['status'];
                $proposal->interview_status = $validated['status'];
                $proposal->final_status = $validated['status'];

                $proposal->save();

                $response = $this->setResponse(
                    success: true,
                    title: 'Status berhasil diperbarui!',
                    message: 'Silahkan hubungi kontak pelamar untuk konfirmasi!',
                    icon: asset('storage/svg/success-checkmark.svg')
                );

                // send an email aferward
                $company = auth('web')->user()->load('company.profile');
                $companyFullName = ($company->company->profile->first_name ?? 'Username') . ' ' . $company->company->profile->last_name ?? '';
                $studentFullName = ($proposal->student->profile->first_name ?? 'Username') . ' ' . $proposal->student->profile->last_name ?? '';
                $vacancyTitle = $proposal->vacancy->title;

                $mail = (new WaitingProposal($companyFullName, $studentFullName, $vacancyTitle))
                    ->onConnection('database')
                    ->onQueue('default');
                Mail::to($proposal->student->account)->queue($mail);

                return response()->json($response);
            }

            // send an email afterward

            $response = $this->setResponse(
                success: true,
                title: 'Status tidak diperbarui!',
                message: 'Tidak ada status yang diperbarui!',
                icon: asset('storage/svg/success-checkmark.svg')
            );

            return response()->json($response);
        } catch (\Throwable $e) {
            $response = $this->setResponse(
                success: false,
                message: 'Terjadi kesalahan saat melakukan update',
                icon: asset('storage/svg/failed-x.svg')
            );

            // return response()->json($e->getMessage());
            return response()->json($response, 500);
        }
    }

    // method request ubah status wawancara
    public function updateStatusApplicantInterview(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_proposal' => ['required', 'integer', 'present', 'min:1'],
                'status' => ['required', 'string', 'present', Rule::in(['waiting', 'approved', 'rejected'])]
            ]);

            $interview = Proposal::select('proposal_status', 'nim', 'id_proposal', 'interview_date', 'interview_status', 'final_status', 'id_vacancy')
                ->with([
                    'student' => function ($query) {
                        $query->select('nim', 'id_user', 'approved_datetime', 'id_profile')->with(['account' => function ($query) {
                            $query->select('id_user', 'email');
                        }]);
                    },
                    'student.profile' => function ($query) {
                        $query->select('id_profile', 'first_name', 'last_name');
                    },
                    'vacancy' => function ($query) {
                        $query->select('id_vacancy', 'nib', 'title')->with(['company' => function ($query) {
                            $query->select('nib', 'id_profile')->with(['profile' => function ($query) {
                                $query->select('id_profile', 'first_name', 'last_name');
                            }]);
                        }]);
                    }
                ])
                ->where('id_proposal', $validated['id_proposal'])
                ->first();

            // check apakah $interview kosong
            if (empty($interview) === true) {
                $response = $this->setResponse(
                    success: false,
                    title: 'Data tidak ditemukan!',
                    message: 'Tidak dapat melakukan update, data tidak ditemukan',
                    icon: asset('storge/svg/failed-x.svg')
                );

                return response()->json($response);
            }

            // check apakah approved_datetime terisi, interview_date terisi, proposal_status adalah approved dan status approved
            if ($interview->student->approved_datetime == true && $interview->interview_date == true && $interview->proposal_status === 'approved' && $validated['status'] === 'approved') {
                $interview->interview_status = $validated['status'];
                $interview->final_status = $validated['status'];
                $interview->save();

                // send an email afterward
                $company = auth('web')->user()->load('company.profile');
                $companyFullName = ($company->company->profile->first_name ?? 'Username') . ' ' . $company->company->profile->last_name ?? '';
                $studentFullName = ($interview->student->profile->first_name ?? 'Username') . ' ' . $interview->student->profile->last_name ?? '';
                $vacancyTitle = $interview->vacancy->title;

                $mail = (new ApprovedInterview($companyFullName, $studentFullName, $vacancyTitle))
                    ->onConnection('database')
                    ->onQueue('default');
                Mail::to($interview->student->account)->queue($mail);

                $response = $this->setResponse(
                    success: true,
                    title: 'Status berhasil diperbarui!',
                    message: 'Silahkan hubungi kontak pelamar untuk melakukan konfirmasi',
                    icon: asset('storage/svg/success-checkmark.svg')
                );

                return response()->json($response);
            }

            // check apakah status rejected
            if ($validated['status'] === 'rejected') {
                $interview->interview_date = null;
                $interview->interview_status = $validated['status'];
                $interview->proposal_status = $validated['status'];
                $interview->final_status = $validated['status'];
                $interview->student->approved_datetime = null;

                $interview->save();
                $interview->student->save();

                // send an email afterward
                $company = auth('web')->user()->load('company.profile');
                $companyFullName = ($company->company->profile->first_name ?? 'Username') . ' ' . $company->company->profile->last_name ?? '';
                $studentFullName = ($interview->student->profile->first_name ?? 'Username') . ' ' . $interview->student->profile->last_name ?? '';
                $vacancyTitle = $interview->vacancy->title;

                $mail = (new RejectedInterview($companyFullName, $studentFullName, $vacancyTitle))
                    ->onConnection('database')
                    ->onQueue('default');
                Mail::to($interview->student->account)->queue($mail);

                $response = $this->setResponse(
                    success: true,
                    title: 'Status berhasil diperbarui!',
                    message: 'Silahkan hubungi kontak pelamar untuk konfirmasi',
                    icon: asset('storage/svg/success-checkmark.svg')
                );

                return response()->json($response);
            }

            // check apakah status waiting
            if ($validated['status'] === 'waiting') {
                $interview->interview_date = null;
                $interview->interview_status = $validated['status'];
                $interview->final_status = $validated['status'];

                $interview->save();

                // send an email afterward
                $company = auth('web')->user()->load('company.profile');
                $companyFullName = ($company->company->profile->first_name ?? 'Username') . ' ' . $company->company->profile->last_name ?? '';
                $studentFullName = ($interview->student->profile->first_name ?? 'Username') . ' ' . $interview->student->profile->last_name ?? '';
                $vacancyTitle = $interview->vacancy->title;

                $mail = (new WaitingInterview($companyFullName, $studentFullName, $vacancyTitle))
                    ->onConnection('database')
                    ->onQueue('default');
                Mail::to($interview->student->account)->queue($mail);

                $response = $this->setResponse(
                    success: true,
                    title: 'Status berhasil diperbarui!',
                    message: 'Silahkan hubungi kontak pelamar untuk konfirmasi!',
                    icon: asset('storage/svg/success-checkmark.svg')
                );

                return response()->json($response);
            }

            $response = $this->setResponse(
                success: true,
                title: 'Status tidak diperbarui!',
                message: 'Tidak ada status yang diperbarui',
                icon: asset('storage/svg/success-checkmark.svg')
            );

            return response()->json($response);
        } catch (\Throwable $e) {
            $response = $this->setResponse(
                success: false,
                title: 'Request error',
                message: 'Terjadi kesalahan saat melakukan update',
                icon: 'storage/svg/failed-x.svg'
            );
            return response()->json($response, 500);
        }
    }

    // method request atur tanggal interview
    public function setInterviewDate(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'interview_date' => ['nullable', 'present', 'date_format:Y-m-d\TH:i', 'after:tomorrow'],
            'id_proposal' => ['required', 'present', 'integer', 'min:1']
        ]);

        // check apakah validasi gagal
        if ($validator->fails()) {
            $response = $this->setResponse(
                success: false,
                message: 'Format tanggal dan waktu salah, hatap coba lagi!',
                type: 'danger'
            );

            return response()->json($response);
        }

        $proposal = Proposal::select('interview_date', 'proposal_status', 'interview_status')
            ->where('id_proposal', $validator->getValue('id_proposal'))
            ->first();

        // check apakah $proposal kosong
        if (empty($proposal) === true) {
            $response = $this->setResponse(
                success: false,
                message: 'Gagal atur tanggal, data tidak ditemukan',
                type: 'danger'
            );

            return response()->json($response);
        }

        // check apakah status proposal bukan approved
        if ($proposal->proposal_status !== 'approved') {
            $response = $this->setResponse(
                success: false,
                message: 'Gagal atur tanggal, status lamaran harus diterima',
                type: 'danger'
            );

            return response()->json($response);
        }

        // check apakah status interview status adalah rejected atau approved
        if (in_array($proposal->interview_status, ['rejected', 'approved'])) {
            $response = $this->setResponse(
                success: false,
                message: 'Gagal atur tanggal, status wawancara harus menunggu',
                type: 'danger'
            );

            return response()->json($response);
        }

        $proposal->interview_date = $validator->getValue('interview_date') === null ? null : date('Y-m-d H:i:s', strtotime($validator->getValue('interview_date')));
        $proposal->id_proposal = $validator->getValue('id_proposal');
        $proposal->save();

        $response = $this->setResponse(
            success: true,
            message: 'Berhasil atur tanggal dan waktu wawancaara',
            type: 'primary'
        );

        return response()->json($response);
    }

    private function setResponse(
        bool $success = true,
        string $title = '',
        string $message = '',
        string $type = '',
        string $icon = '',
        array $additional = []
    ): array {
        $response = [
            'success' => $success,
            'notification' => [
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'icon' => $icon
            ]
        ];

        if ($additional !== []) {
            $response['additional'] = $additional;
        }

        return $response;
    }
}
