<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Manufacturer;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\ManufacturerRepositoryInterface;

class ManufacturerRepository extends BaseRepository implements ManufacturerRepositoryInterface
{
    public function __construct(Manufacturer $model)
    {
        $this->model = $model;
    }
}