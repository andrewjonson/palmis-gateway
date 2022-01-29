<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\References\UacsObjectCode;
use App\Repositories\Interfaces\v1\References\UacsObjectCodeRepositoryInterface;

class UacsObjectCodeRepository extends BaseRepository implements UacsObjectCodeRepositoryInterface
{
    public function __construct(UacsObjectCode $model)
    {
        $this->model = $model;
    }
}