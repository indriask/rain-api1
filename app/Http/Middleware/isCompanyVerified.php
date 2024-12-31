<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isCompanyVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->ajax()) {
            if (auth('web')->user()->company->status_verified_at !== null) {
                return $next($request);
            } else {
                $response = $this->setResponse(
                    success: false,
                    title: 'Akses ditolak',
                    message: 'Akun anda belum diverifikasi, silahkan hubungi admin untuk konfirmasi',
                    icon: asset('storage/svg/failed-x.svg')
                );

                return response()->json($response, 400);
            }
        }

        if (auth('web')->user()->company->status_verified_at !== null) {
            return $next($request);
        } else {
            return abort(404);
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
