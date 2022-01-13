<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\IssuanceDirectiveItem;
use App\Repositories\Interfaces\v1\Transactions\IssuanceDirectiveItemRepositoryInterface;

class IssuanceDirectiveItemRepository extends BaseRepository implements IssuanceDirectiveItemRepositoryInterface
{
    public function __construct(IssuanceDirectiveItem $model)
    {
        $this->model = $model;
    }
}