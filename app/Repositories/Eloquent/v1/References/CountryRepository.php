<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\Country;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\CountryRepositoryInterface;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    public function __construct(Country $model)
    {
        $this->model = $model;
    }
}