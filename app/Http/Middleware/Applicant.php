<?php

namespace App\Http\Middleware;

use Closure;

class Applicant
{
    public function handle($request, Closure $next)
    {
        $this->auth =
            auth()->user() ?
            (auth()->user()->role === 'applicant')
            : false;

        if ($this->auth == true)
            return $next($request);

        return redirect()->route('login');
    }
}
