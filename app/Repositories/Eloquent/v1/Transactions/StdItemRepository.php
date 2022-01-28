<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\StdItem;
use App\Repositories\Interfaces\v1\Transactions\StdItemRepositoryInterface;

class StdItemRepository extends BaseRepository implements StdItemRepositoryInterface
{
    public function __construct(StdItem $model)
    {
        $this->model = $model;
    }
}