<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\Dda;
use App\Repositories\Interfaces\v1\Transactions\DdaRepositoryInterface;

class DdaRepository extends BaseRepository implements DdaRepositoryInterface
{
    public function __construct(Dda $model)
    {
        $this->model = $model;
    }
}