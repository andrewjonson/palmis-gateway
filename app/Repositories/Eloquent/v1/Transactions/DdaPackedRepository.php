<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\DdaPacked;
use App\Repositories\Interfaces\v1\Transactions\DdaPackedRepositoryInterface;

class DdaPackedRepository extends BaseRepository implements DdaPackedRepositoryInterface
{
    public function __construct(DdaPacked $model)
    {
        $this->model = $model;
    }
}