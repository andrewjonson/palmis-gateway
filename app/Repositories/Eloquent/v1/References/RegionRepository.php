<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Region;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\RegionRepositoryInterface;

class RegionRepository extends BaseRepository implements RegionRepositoryInterface
{
    public function __construct(Region $model)
    {
        $this->model = $model;
    }
}