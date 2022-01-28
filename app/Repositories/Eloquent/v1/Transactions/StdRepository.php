<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\Std;
use App\Repositories\Interfaces\v1\Transactions\StdRepositoryInterface;

class StdRepository extends BaseRepository implements StdRepositoryInterface
{
    public function __construct(Std $model)
    {
        $this->model = $model;
    }
}