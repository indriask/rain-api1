<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Egulias\EmailValidator\Result\Reason\ExpectingCTEXT;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardStudentController extends Controller
{
    /**
     * Method untuk mem-proses logika melihat status lamaran mahasiswa
     */
    public function getProposalStatus(Request $request)
    {
        $validator = Validator::make($request->input(), ['id_proposal' => ['required', 'integer', 'present']]);
        if ($validator->fails()) {
            $response = $this->setResponse(
                success: false,
                title: 'Validasi error',
                message: 'Terjadi kesalahaan saat melakukan validasi, silahkan coba lagi',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response()->json($response, 500);
        }

        try {
            $status = Proposal::where('id_proposal', $validator->getValue('id_proposal'))
                ->where('nim', auth('web')->user()->student->nim)
                ->firstOrFail();

            if ($status->proposal_status === 'approved') {
                $response = $this->setResponse(
                    success: true,
                    title: 'Lamaranmu diterima!',
                    message: 'Silahkan menunggu konfirmasi selanjutnya ya',
                    icon: asset('storage/svg/success-checkmark.svg')
                );
                $response['status'] = 'approved';

                return response()->json($response, 200);
            }

            if ($status->proposal_status === 'waiting') {
                $response = $this->setResponse(
                    success: true,
                    title: 'Lamaranmu sedang di proses!',
                    message: 'Silahkan menunggu konfirmasi selanjutnya ya',
                    icon: asset('storage/svg/success-checkmark.svg')
                );
                $response['status'] = 'waiting';

                return response()->json($response, 200);
            }

            if ($status->proposal_status === 'rejected') {
                $response = $this->setResponse(
                    success: true,
                    title: 'Lamaranmu ditolak:(',
                    message: 'Tetap semangat dan coba lagi di lain waktu ya!',
                    icon: asset('storage/svg/failed-x.svg')
                );
                $response['status'] = 'rejected';

                return response()->json($response, 200);
            }

            return throw new Exception();
        } catch (\Throwable $e) {
            $response = $this->setResponse(
                success: false,
                title: 'Request gagal',
                message: 'Terjadi kesalahaan saat melakukan request, silahkan coba lagi',
                icon: asset('storage/svg/failed-x.svg')
            );

            // return response()->json($response, 500);
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Method untuk mem-proses logika melihat status wawancara mahasiswa
     */
    public function getInterviewStatus(Request $request)
    {
        $validator = Validator::make($request->input(), ['id_proposal' => ['required', 'integer', 'present']]);
        if ($validator->fails()) {
            $response = $this->setResponse(
                success: false,
                title: 'Validasi error',
                message: 'Terjadi kesalahaan saat melakukan validasi, silahkan coba lagi',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response()->json($response, 500);
        }

        try {
            $status = Proposal::where('id_proposal', $validator->getValue('id_proposal'))
                ->where('nim', auth('web')->user()->student->nim)
                ->firstOrFail();

            if ($status->interview_status === 'approved') {
                $response = $this->setResponse(
                    success: true,
                    title: 'Wawancaramu diterima!',
                    message: 'Silahkan menunggu konfirmasi selanjutnya ya',
                    icon: asset('storage/svg/success-checkmark.svg')
                );
                $response['status'] = 'approved';

                return response()->json($response, 200);
            }

            if ($status->interview_status === 'waiting') {
                $response = $this->setResponse(
                    success: true,
                    title: 'Wawancaramu sedang di proses!',
                    message: 'Silahkan menunggu konfirmasi selanjutnya ya',
                    icon: asset('storage/svg/success-checkmark.svg')
                );
                $response['status'] = 'waiting';

                return response()->json($response, 200);
            }

            if ($status->interview_status === 'rejected') {
                $response = $this->setResponse(
                    success: true,
                    title: 'Wawancaramu ditolak:(',
                    message: 'Tetap semangat dan coba lagi di lain waktu ya!',
                    icon: asset('storage/svg/failed-x.svg')
                );
                $response['status'] = 'rejected';

                return response()->json($response, 200);
            }

            return throw new Exception();
        } catch (\Throwable $e) {
            $response = $this->setResponse(
                success: false,
                title: 'Request gagal',
                message: 'Terjadi kesalahaan saat melakukan request, silahkan coba lagi',
                icon: asset('storage/svg/failed-x.svg')
            );

            // return response()->json($response, 500);
            return response()->json($e->getMessage(), 500);
        }
    }

    // Method untuk mem-proses logika daftar lamaran mahasiswa
    public function applyVacancy(Request $request) {}

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
