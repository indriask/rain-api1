<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->ajax()) {
            if ($this->handleHeader($request->header('x-get-data', null))) {
                return $next($request);
            }

            $response = $this->setResponse(
                success: false,
                title: 'Request ditolak',
                message: 'Request telah kadaluarsa, silahkan coba lagi',
                icon: asset('storage/svg/failed-x.svg')
            );

            return response($response, 500);
        }

        abort(404);
    }

    private function handleHeader(string $header)
    {
        if ($header === 'get-student-profile-data') {
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
