<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Fssu;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\FssuRepositoryInterface;

class FssuRepository extends BaseRepository implements FssuRepositoryInterface
{
    public function __construct(Fssu $model)
    {
        $this->model = $model;
    }
}