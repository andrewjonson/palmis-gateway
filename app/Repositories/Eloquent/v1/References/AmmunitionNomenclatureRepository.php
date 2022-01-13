<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\References\AmmunitionNomenclature;
use App\Repositories\Interfaces\v1\References\AmmunitionNomenclatureRepositoryInterface;

class AmmunitionNomenclatureRepository extends BaseRepository implements AmmunitionNomenclatureRepositoryInterface
{
    public function __construct(AmmunitionNomenclature $model)
    {
        $this->model = $model;
    }
}