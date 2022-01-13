<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\EndUser;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\EndUserRepositoryInterface;

class EndUserRepository extends BaseRepository implements EndUserRepositoryInterface
{
    public function __construct(EndUser $model)
    {
        $this->model = $model;
    }
}