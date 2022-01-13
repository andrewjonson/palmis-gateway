<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\References\AmmunitionClassification;
use App\Repositories\Interfaces\v1\References\AmmunitionClassificationRepositoryInterface;

class AmmunitionClassificationRepository extends BaseRepository implements AmmunitionClassificationRepositoryInterface
{
    public function __construct(AmmunitionClassification $model)
    {
        $this->model = $model;
    }
}