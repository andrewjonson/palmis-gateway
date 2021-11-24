<?php

namespace App\Services\ApiService\v1;

use App\Traits\ConsumeExternalService;

class PaisTemplateService
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.api_gateway.base_url');
        $this->secret = config('services.accepted_secret');
    }

    public function currentUserIdTeamId()
    {
        return $this->performRequest('GET', '/api/users/current-user-id-team-id');
    }
}