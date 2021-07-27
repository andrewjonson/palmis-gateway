<?php
namespace App\Traits;

use App\Scopes\ModularScope;
use Illuminate\Auth\AuthenticationException;
use App\Services\ApiService\v1\PaisTemplateService;

trait ModularTrait
{
    protected static function booted()
    {
        static::addGlobalScope(new ModularScope);
        if (!app()->runningInConsole()) {
            try {
                $service = new PaisTemplateService;
                $userId = $service->currentUser()['data']['id'];
                $teamId = $service->currentUser()['data']['team_id'];
                $userId = hashid_decode($userId);
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