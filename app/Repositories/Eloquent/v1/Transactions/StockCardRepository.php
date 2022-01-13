<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Models\v1\Transactions\StockCard;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\Transactions\StockCardRepositoryInterface;

class StockCardRepository extends BaseRepository implements StockCardRepositoryInterface
{
    public function __construct(StockCard $model)
    {
        $this->model = $model;
    }
}