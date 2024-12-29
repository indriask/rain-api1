<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->ajax()) {
            if($this->validateRole() === true) {
                return $next($request);
            } else {
                return response(status: 403);
            }
        }

        if($this->validateRole()) {
            return $next($request);
        } else {
            return back();
        }
    }

    private function validateRole()
    {
        if (auth('web')->user()->role === 3) {
            return true;
        }

        return false;
    }
}
