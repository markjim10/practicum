<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SysAdmin
{
    public function handle($request, Closure $next)
    {
        $this->auth = auth()->user() ? (auth()->user()->role === 'sysadmin') : false;

        if ($this->auth == true) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
