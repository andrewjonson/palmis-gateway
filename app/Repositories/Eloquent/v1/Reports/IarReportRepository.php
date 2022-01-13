<?php

namespace App\Repositories\Eloquent\v1\Reports;

use App\Models\v1\Reports\IarReport;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\Reports\IarReportRepositoryInterface;

class IarReportRepository extends BaseRepository implements IarReportRepositoryInterface
{
    public function __construct(IarReport $model)
    {
        $this->model = $model;
    }
}