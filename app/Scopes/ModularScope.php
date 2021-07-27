<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Auth\Access\AuthorizationException;

class ModularScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (!app()->runningInConsole()) {
            $service = new PaisTemplateService;
            $user = $service->currentUser();
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