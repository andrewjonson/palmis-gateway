<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\Rsmi;
use App\Repositories\Interfaces\v1\Transactions\RsmiRepositoryInterface;

class RsmiRepository extends BaseRepository implements RsmiRepositoryInterface
{
    public function __construct(Rsmi $model)
    {
        $this->model = $model;
    }
}