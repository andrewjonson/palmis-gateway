<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\AmmunitionType;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\AmmunitionTypeRepositoryInterface;

class AmmunitionTypeRepository extends BaseRepository implements AmmunitionTypeRepositoryInterface
{
    public function __construct(AmmunitionType $model)
    {
        $this->model = $model;
    }
}