<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\References\IssuanceDirectiveCondition;
use App\Repositories\Interfaces\v1\References\IssuanceDirectiveConditionRepositoryInterface;

class IssuanceDirectiveConditionRepository extends BaseRepository implements IssuanceDirectiveConditionRepositoryInterface
{
    public function __construct(IssuanceDirectiveCondition $model)
    {
        $this->model = $model;
    }
}