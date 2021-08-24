<?php
namespace App\Traits;

use App\Scopes\ModularScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\AuthenticationException;

trait ModularTrait
{
    protected static function booted()
    {
        static::addGlobalScope(new ModularScope);
        if (!app()->runningInConsole()) {
            try {
                $user = Cache::get('current-user')['data'];
                $teamId = $user['team']['id'];
                $userId = $user['id'];
                $userId = hashid_decode($userId);
                $teamId = hashid_decode($teamId);
                static::creating(function ($model) use($userId, $teamId) {
                    $model->team_id = $teamId;
                    $model->created_by = $userId;
                });

                static::updating(function ($model) use($userId) {
                    $model->updated_by = $userId;
                });

                static::deleting(function ($model) use($userId) {
                    $model->deleted_by = $userId;
                });
            } catch (\Exception $e) {
                throw new AuthenticationException;
            }
        }
    }
}