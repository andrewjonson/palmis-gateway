<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\UserWarehouse;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\UserWarehouseRepositoryInterface;

class UserWarehouseRepository extends BaseRepository implements UserWarehouseRepositoryInterface
{
    public function __construct(UserWarehouse $model)
    {
        $this->model = $model;
    }
}