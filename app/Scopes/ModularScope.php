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
            $user = auth()->user();
            if (empty($user->userWithTeam->team_id)) {
                throw new AuthorizationException;
            }
            $builder->whereHas('creator', function($query) use($user) {
                $query->whereHas('userWithTeam', function($query) use($user) {
                    $query->where('team_id', User::where('id', $user->id)->with('userWithTeam')->first()->userWithTeam->team_id);
                });
            });
        }
    }
}