<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Make;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\MakeRepositoryInterface;

class MakeRepository extends BaseRepository implements MakeRepositoryInterface
{
    public function __construct(Make $model)
    {
        $this->model = $model;
    }
}