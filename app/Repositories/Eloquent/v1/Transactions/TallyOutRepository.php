<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\TallyOut;
use App\Repositories\Interfaces\v1\Transactions\TallyOutRepositoryInterface;

class TallyOutRepository extends BaseRepository implements TallyOutRepositoryInterface
{
    public function __construct(TallyOut $model)
    {
        $this->model = $model;
    }
}