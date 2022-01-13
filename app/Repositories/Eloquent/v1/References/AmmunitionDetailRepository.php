<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\AmmunitionDetail;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\AmmunitionDetailRepositoryInterface;

class AmmunitionDetailRepository extends BaseRepository implements AmmunitionDetailRepositoryInterface
{
    public function __construct(AmmunitionDetail $model)
    {
        $this->model = $model;
    }
}