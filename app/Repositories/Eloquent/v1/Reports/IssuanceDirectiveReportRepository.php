<?php

namespace App\Repositories\Eloquent\v1\Reports;

use App\Repositories\Eloquent\v1\BaseRepository;
use App\Models\v1\Reports\IssuanceDirectiveReport;
use App\Repositories\Interfaces\v1\Reports\IssuanceDirectiveReportRepositoryInterface;

class IssuanceDirectiveReportRepository extends BaseRepository implements IssuanceDirectiveReportRepositoryInterface
{
    public function __construct(IssuanceDirectiveReport $model)
    {
        $this->model = $model;
    }
}