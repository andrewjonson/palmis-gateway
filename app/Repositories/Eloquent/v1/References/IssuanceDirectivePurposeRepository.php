<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\References\IssuanceDirectivePurpose;
use App\Repositories\Interfaces\v1\References\IssuanceDirectivePurposeRepositoryInterface;

class IssuanceDirectivePurposeRepository extends BaseRepository implements IssuanceDirectivePurposeRepositoryInterface
{
    public function __construct(IssuanceDirectivePurpose $model)
    {
        $this->model = $model;
    }
}