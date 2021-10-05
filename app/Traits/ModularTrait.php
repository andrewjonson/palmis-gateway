<?php
namespace App\Traits;

use App\Scopes\ModularScope;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\AuthenticationException;
use App\Services\ApiService\v1\PaisTemplateService;

trait ModularTrait
{
    use ResponseTrait;
    
    protected static function booted()
    {
        static::addGlobalScope(new ModularScope);
        if (!app()->runningInConsole()) {
            $token = request()->bearerToken();
            if ($token) {
                try {
                    if (!Cache::has('current-user-'.$token)) {
                        $service = new PaisTemplateService;
                        $user = $service->currentUser();
                        Cache::set('current-user-'.$token, $user, 500);
                    } else {
                        $user = Cache::get('current-user-'.$token);
                    }
                    
                    $teamId = $user['data']['team']['id'];
                    $userId = $user['data']['id'];
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
                } catch(\Exception $e) {
                    throw new AuthenticationException;
                }
            }
        }
    }
}