<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Province;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\ProvinceRepositoryInterface;

class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{
    public function __construct(Province $model)
    {
        $this->model = $model;
    }
}