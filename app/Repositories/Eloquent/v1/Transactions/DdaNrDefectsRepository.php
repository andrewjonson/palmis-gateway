<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\DdaNrDefects;
use App\Repositories\Interfaces\v1\Transactions\DdaNrDefectsRepositoryInterface;

class DdaNrDefectsRepository extends BaseRepository implements DdaNrDefectsRepositoryInterface
{
    public function __construct(DdaNrDefects $model)
    {
        $this->model = $model;
    }
}