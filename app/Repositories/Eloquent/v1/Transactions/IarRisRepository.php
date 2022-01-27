<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\IarRis;
use App\Repositories\Interfaces\v1\Transactions\IarRisRepositoryInterface;

class IarRisRepository extends BaseRepository implements IarRisRepositoryInterface
{
    public function __construct(IarRis $model)
    {
        $this->model = $model;
    }
}