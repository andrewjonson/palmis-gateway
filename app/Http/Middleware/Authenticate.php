<?php

namespace App\Http\Middleware;

use Closure;
use App\Traits\ResponseTrait;
use Illuminate\Auth\AuthenticationException;
use App\Services\ApiService\PaisTemplateService;

class Authenticate
{
    use ResponseTrait;

    public function __construct(PaisTemplateService $paisTemplateService)
    {
        $this->paisTemplateService = $paisTemplateService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = $this->paisTemplateService->currentUser();
            if(!$user) throw new AuthenticationException;
            // if ($user['deleted_at']) {
            //     if (!$user['auth_status']) {
            //         throw new AuthorizationException;
            //     } 
            //     $user->update([
            //         'auth_status' => false
            //     ]);

            //     return $this->failedResponse('You have been deleted', 403);
            // }
            if (!$user['data']['email_verified_at'] || $user['data']['screen_lock']) {
                throw new AuthenticationException;
            }
        } catch(\Exception $e) {
            throw new AuthenticationException;
        }

        return $next($request);
    }
}
