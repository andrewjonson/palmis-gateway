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
            if (!$this->user['is_superadmin']) {
                if (!$this->user['team_id']) {
                    throw new AuthorizationException;
                }

                $teamId = hashid_decode($this->user['team_id']);
                $builder->where('team_id', $teamId);
            }
        }
    }
}