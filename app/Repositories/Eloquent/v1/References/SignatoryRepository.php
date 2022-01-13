<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Signatory;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\SignatoryRepositoryInterface;

class SignatoryRepository extends BaseRepository implements SignatoryRepositoryInterface
{
    public function __construct(Signatory $model)
    {
        $this->model = $model;
    }
}