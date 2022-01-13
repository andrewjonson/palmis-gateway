<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\AmmunitionCategory;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\AmmunitionCategoryRepositoryInterface;

class AmmunitionCategoryRepository extends BaseRepository implements AmmunitionCategoryRepositoryInterface
{
    public function __construct(AmmunitionCategory $model)
    {
        $this->model = $model;
    }
}