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
        $this->baseUrl = config('app.api_gateway_base_url');
        $this->secret = config('app.accepted_secret');
    }

    public function currentUser()
    {
        return $this->performRequest('GET', '/api/users/current-user');
    }
}