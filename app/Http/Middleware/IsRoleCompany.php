<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsRoleCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // kirim status 403 jika request berasal dari ajax
        if($request->ajax()) {
            if($this->validateRole() === true) {
                return $next($request);
            } else {
                return response(status: 403);
            }
        }

        // arahkan user kembali ke halaman sebelumnya
        if($this->validateRole() === true) {
            return $next($request);
        } else {
            return back();
        }
    }

    private function validateRole() {
        if(auth('web')->user()->role === 2) {
            return true;
        }

        return false;
    }
}
