<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\References\ResponsibilityCode;
use App\Repositories\Interfaces\v1\References\ResponsibilityCodeRepositoryInterface;

class ResponsibilityCodeRepository extends BaseRepository implements ResponsibilityCodeRepositoryInterface
{
    public function __construct(ResponsibilityCode $model)
    {
        $this->model = $model;
    }
}