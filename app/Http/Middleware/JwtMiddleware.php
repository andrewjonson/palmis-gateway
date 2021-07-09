<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Traits\ResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Auth\Access\AuthorizationException;

class JwtMiddleware
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
            if( !$user ) throw new UnauthorizedException;
            if ($user->deleted_at) {
                if (! $user->auth_status) {
                    throw new AuthorizationException;
                } 
                $user->update([
                    'auth_status' => false
                ]);
                auth()->invalidate();
                return $this->failedResponse('You have been deleted', 403);
            }
        } catch (Exception $e) {
            throw new UnauthorizedException;
        }

        return $next($request);
    }
}