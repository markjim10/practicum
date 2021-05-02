<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next)
    {
        $this->auth =
            auth()->user() ?
            (auth()->user()->role === 'admin')
            : false;

        if ($this->auth == true)
            return $next($request);

        return redirect()->route('login');
    }
}
