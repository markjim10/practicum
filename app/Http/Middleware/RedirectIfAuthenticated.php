<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            $role = Auth::user()->role;

            if ($role == 'admin') {
                return redirect('/admins');
            } elseif ($role == 'applicant') {
                return redirect('/applicants');
            } elseif ($role == 'sysadmin') {
                return redirect('/sysadmins');
            }
        }

        return $next($request);
    }
}
