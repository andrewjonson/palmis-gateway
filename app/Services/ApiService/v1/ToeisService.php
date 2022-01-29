<?php

namespace App\Services\ApiService\v1;

use App\Traits\ConsumeExternalService;

class ToeisService
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.toeis.base_url');
        $this->secret = config('services.toeis.secret');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/toeis/unit-all-active', $data);
    }

    public function getUnitById($id)
    {
        return $this->performRequest('GET', '/toeis/unit-per-id/'.$id);
    }

    public function getUnitConcatById($id)
    {
        return $this->performRequest('GET', '/toeis/unit-concat/'.$id);
    }

    public function getUnit($data)
    {
        return $this->performRequest('GET', '/toeis/unit', $data);
    }

    public function createUnit($data)
    {
        return $this->performRequest('POST', '/toeis/unit', $data);
    }

    public function getToggleUnit($id)
    {
        return $this->performRequest('GET', '/toeis/toggle-unit-per-id/'.$id);
    }

    public function getToggleUnitName($id)
    {
        return $this->performRequest('GET', '/api/v1/toeis/toggle-unit-name/'.$id);
    }
}