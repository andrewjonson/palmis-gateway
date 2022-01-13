<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Models\v1\Transactions\Ris;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\Transactions\RisRepositoryInterface;

class RisRepository extends BaseRepository implements RisRepositoryInterface
{
    public function __construct(Ris $model)
    {
        $this->model = $model;
    }
}