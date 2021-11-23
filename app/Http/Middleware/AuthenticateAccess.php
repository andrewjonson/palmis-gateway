<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;

class AuthenticateAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validSecret = explode(',', env('ACCEPTED_SECRET'));

        if(in_array($request->header('X-Authorization'), $validSecret)) {
            return $next($request);
        }

        throw new AuthenticationException;
    }
}