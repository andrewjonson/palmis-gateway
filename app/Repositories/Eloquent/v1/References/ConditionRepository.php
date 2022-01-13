<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Condition;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\ConditionRepositoryInterface;

class ConditionRepository extends BaseRepository implements ConditionRepositoryInterface
{
    public function __construct(Condition $model)
    {
        $this->model = $model;
    }
}