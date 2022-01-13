<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\ServicingFpao;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\ServicingFpaoRepositoryInterface;

class ServicingFpaoRepository extends BaseRepository implements ServicingFpaoRepositoryInterface
{
    public function __construct(ServicingFpao $model)
    {
        $this->model = $model;
    }
}