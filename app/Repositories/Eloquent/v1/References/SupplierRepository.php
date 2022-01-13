<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Supplier;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\SupplierRepositoryInterface;

class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
{
    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }
}