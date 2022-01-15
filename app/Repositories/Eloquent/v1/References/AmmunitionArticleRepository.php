<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\References\AmmunitionArticle;
use App\Repositories\Interfaces\v1\References\AmmunitionArticleRepositoryInterface;

class AmmunitionArticleRepository extends BaseRepository implements AmmunitionArticleRepositoryInterface
{
    public function __construct(AmmunitionArticle $model)
    {
        $this->model = $model;
    }
}