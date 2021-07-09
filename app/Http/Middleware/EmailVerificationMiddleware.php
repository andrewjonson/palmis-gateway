<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Traits\ResponseTrait;
use Illuminate\Validation\UnauthorizedException;

class EmailVerificationMiddleware
{
    use ResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = auth()->user();
            if ($user->email_verified_at == null) {
                throw new UnauthorizedException;
            }
        } catch(Exception $e) {
            throw new UnauthorizedException;
        }

        return $next($request);
    }
}