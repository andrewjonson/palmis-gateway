<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\PtisItems;
use App\Repositories\Interfaces\v1\Transactions\PtisItemsRepositoryInterface;

class PtisItemsRepository extends BaseRepository implements PtisItemsRepositoryInterface
{
    public function __construct(PtisItems $model)
    {
        $this->model = $model;
    }
}