<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\References\AmmunitionHeadStumpMarking;
use App\Repositories\Interfaces\v1\References\AmmunitionHeadStumpMarkingRepositoryInterface;

class AmmunitionHeadStumpMarkingRepository extends BaseRepository implements AmmunitionHeadStumpMarkingRepositoryInterface
{
    public function __construct(AmmunitionHeadStumpMarking $model)
    {
        $this->model = $model;
    }
}