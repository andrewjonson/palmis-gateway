<?php

namespace App\Services\ApiService;

use App\Traits\ConsumeExternalService;

class PaisTemplateService
{
    use ConsumeExternalService;

    public function currentUser()
    {
        return $this->performRequest('GET', '/users/current-user');
    }
}