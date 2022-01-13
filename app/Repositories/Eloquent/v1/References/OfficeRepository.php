<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Office;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\OfficeRepositoryInterface;

class OfficeRepository extends BaseRepository implements OfficeRepositoryInterface
{
    public function __construct(Office $model)
    {
        $this->model = $model;
    }
}