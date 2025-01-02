<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsRoleStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // kirim status 403 jika request berasal dari ajax
        if ($request->ajax()) {
            if ($this->validateRole() === true) {
                return $next($request);
            } else {
                $response = $this->setResponse(
                    success: false,
                    title: 'Akses ditolak',
                    message: 'Anda tidak memiliki izin yang diperlukan untuk mengakses endpoint ini',
                    icon: asset('storage/svg/failed-x.svg')
                );

                return response($response, 403);
            }
        }

        // arahkan user kembali ke halaman sebelumnya
        if ($this->validateRole() === true) {
            return $next($request);
        } else {
            return abort(403);
        }
    }

    private function validateRole()
    {
        if (auth('web')->user()->role === 1) {
            return true;
        }

        return false;
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
