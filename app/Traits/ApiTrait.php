<?php
namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait ApiTrait
{
    public function apiPost($api, $params)
    {
        return Http::post($api, [
            $params
        ])->json();
    }

    public function apiGet($api)
    {
        return Http::get($api)->json();
    }
}