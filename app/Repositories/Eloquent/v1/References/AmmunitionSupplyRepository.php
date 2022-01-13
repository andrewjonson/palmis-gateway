<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\AmmunitionSupply;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\AmmunitionSupplyRepositoryInterface;

class AmmunitionSupplyRepository extends BaseRepository implements AmmunitionSupplyRepositoryInterface
{
    public function __construct(AmmunitionSupply $model)
    {
        $this->model = $model;
    }
}