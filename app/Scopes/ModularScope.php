<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Auth\Access\AuthorizationException;

class ModularScope implements Scope
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function apply(Builder $builder, Model $model)
    {
        if (!app()->runningInConsole()) {
            if (!$this->user['data']['is_superadmin']) {
                if (!$this->user['data']['team']) {
                    throw new AuthorizationException;
                }

                $teamId = hashid_decode($this->user['data']['team']['id']);
                $builder->where('team_id', $teamId);
            }
        }
    }
}