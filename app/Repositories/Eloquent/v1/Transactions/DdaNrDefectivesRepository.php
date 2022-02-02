<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\DdaNrDefectives;
use App\Repositories\Interfaces\v1\Transactions\DdaNrDefectivesRepositoryInterface;

class DdaNrDefectivesRepository extends BaseRepository implements DdaNrDefectivesRepositoryInterface
{
    public function __construct(DdaNrDefectives $model)
    {
        $this->model = $model;
    }
}