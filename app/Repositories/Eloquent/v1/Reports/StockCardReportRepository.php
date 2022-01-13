<?php

namespace App\Repositories\Eloquent\v1\Reports;

use App\Models\v1\Reports\StockCardReport;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\Reports\StockCardReportRepositoryInterface;

class StockCardReportRepository extends BaseRepository implements StockCardReportRepositoryInterface
{
    public function __construct(StockCardReport $model)
    {
        $this->model = $model;
    }
}