<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\Ptis;
use App\Repositories\Interfaces\v1\Transactions\PtisRepositoryInterface;

class PtisRepository extends BaseRepository implements PtisRepositoryInterface
{
    public function __construct(Ptis $model)
    {
        $this->model = $model;
    }
}