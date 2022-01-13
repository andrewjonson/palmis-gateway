<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\SignatoryCo;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\SignatoryCoRepositoryInterface;

class SignatoryCoRepository extends BaseRepository implements SignatoryCoRepositoryInterface
{
    public function __construct(SignatoryCo $model)
    {
        $this->model = $model;
    }
}