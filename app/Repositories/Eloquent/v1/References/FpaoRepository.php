<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Fpao;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\FpaoRepositoryInterface;

class FpaoRepository extends BaseRepository implements FpaoRepositoryInterface
{
    public function __construct(Fpao $model)
    {
        $this->model = $model;
    }
}