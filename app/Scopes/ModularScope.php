<?php
namespace App\Scopes;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Auth\Access\AuthorizationException;
use App\Services\ApiService\v1\PaisTemplateService;

class ModularScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (!app()->runningInConsole()) {
            $token = request()->bearerToken();
            if(!Cache::has('current-user-'.$token)) {
                $service = new PaisTemplateService;
                $user = $service->currentUser();
                Cache::set('current-user-'.$token, $user, 300);
            }

            $user = Cache::get('current-user-'.$token);
            if (!$user['data']['is_superadmin']) {
                if (!$user['data']['team']) {
                    throw new AuthorizationException;
                }

                $teamId = hashid_decode($user['data']['team']['id']);
                $builder->where('team_id', $teamId);
            }
        }
    }
}