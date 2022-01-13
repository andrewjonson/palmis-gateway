<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\FundCluster;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\FundClusterRepositoryInterface;

class FundClusterRepository extends BaseRepository implements FundClusterRepositoryInterface
{
    public function __construct(FundCluster $model)
    {
        $this->model = $model;
    }
}