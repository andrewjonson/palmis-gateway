<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\AmmunitionUom;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\AmmunitionUomRepositoryInterface;

class AmmunitionUomRepository extends BaseRepository implements AmmunitionUomRepositoryInterface
{
    public function __construct(AmmunitionUom $model)
    {
        $this->model = $model;
    }
}