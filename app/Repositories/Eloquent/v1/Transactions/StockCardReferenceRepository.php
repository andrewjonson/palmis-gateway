<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\StockCardReference;
use App\Repositories\Interfaces\v1\Transactions\StockCardReferenceRepositoryInterface;

class StockCardReferenceRepository extends BaseRepository implements StockCardReferenceRepositoryInterface
{
    public function __construct(StockCardReference $model)
    {
        $this->model = $model;
    }
}