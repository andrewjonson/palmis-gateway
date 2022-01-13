<?php

namespace App\Repositories\Eloquent\v1\Reports;

use App\Models\v1\Reports\TallyInReport;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\Reports\TallyInReportRepositoryInterface;

class TallyInReportRepository extends BaseRepository implements TallyInReportRepositoryInterface
{
    public function __construct(TallyInReport $model)
    {
        $this->model = $model;
    }
}