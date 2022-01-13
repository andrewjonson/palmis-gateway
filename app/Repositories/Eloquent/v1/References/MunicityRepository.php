<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Municity;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\MunicityRepositoryInterface;

class MunicityRepository extends BaseRepository implements MunicityRepositoryInterface
{
    public function __construct(Municity $model)
    {
        $this->model = $model;
    }
}