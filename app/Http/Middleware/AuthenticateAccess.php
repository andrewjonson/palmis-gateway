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
        $apiKey = explode(',', env('API_KEY'));

        if(in_array($request->header('X-Authorization'), $apiKey)) {
            return $next($request);
        }

        throw new AuthenticationException;
    }
}