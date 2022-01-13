<?php

namespace App\Repositories\Eloquent\v1\SUMIS\References;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\SUMIS\References\AmmunitionSizeCalliber;
use App\Repositories\Interfaces\v1\SUMIS\References\AmmunitionSizeCalliberRepositoryInterface;

class AmmunitionSizeCalliberRepository extends BaseRepository implements AmmunitionSizeCalliberRepositoryInterface
{
    public function __construct(AmmunitionSizeCalliber $model)
    {
        $this->model = $model;
    }
}