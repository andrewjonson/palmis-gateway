<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Transactions\IssuanceDirective;
use App\Repositories\Interfaces\v1\Transactions\IssuanceDirectiveRepositoryInterface;

class IssuanceDirectiveRepository extends BaseRepository implements IssuanceDirectiveRepositoryInterface
{
    public function __construct(IssuanceDirective $model)
    {
        $this->model = $model;
    }
}