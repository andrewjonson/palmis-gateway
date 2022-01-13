<?php

namespace App\Repositories\Eloquent\v1\Dashboard;

use App\Models\v1\Dashboard\Dashboard;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\Dashboard\DashboardRepositoryInterface;

class DashboardRepository extends BaseRepository implements DashboardRepositoryInterface
{
    public function __construct(Dashboard $model)
    {
        $this->model = $model;
    }
}