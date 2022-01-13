<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Warehouse;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\WarehouseRepositoryInterface;

class WarehouseRepository extends BaseRepository implements WarehouseRepositoryInterface
{
    public function __construct(Warehouse $model)
    {
        $this->model = $model;
    }
}