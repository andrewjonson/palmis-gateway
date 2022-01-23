<?php

namespace App\Http\Controllers\v1\Reports;

use App\Traits\ResponseTrait;
use App\Models\v1\Reports\IarReport;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\Reports\IarReportResource;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Repositories\Interfaces\v1\Transactions\IarRepositoryInterface;
use App\Repositories\Interfaces\v1\Reports\IarReportRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\TallyInRepositoryInterface;

class IarReportController extends BaseController
{
    use ResponseTrait;

    public function __construct(
        IarReportRepositoryInterface $iarReportRepository, 
        TallyInRepositoryInterface $tallyRepository,
        IarRepositoryInterface $iarRepository,
    )
    {
        $this->modelRepository = $iarReportRepository;
        $this->tallyRepository = $tallyRepository;
        $this->iarRepository = $iarRepository;
        $this->resource = IarReportResource::class;
        $this->modelName = 'Iar Report';
    }

    /**
     * Get Repor List
     * 
     * @param Illuminate\Http\Request
     * @return mixed
     */
    public function getReportIar($id)
    {
        $id = hashid_decode($id);
        $data = $this->tallyRepository->find($id);
        
        if(!$data) {
            throw new AuthorizationException;
        }

        $tallyId = $data->id;
        $iar = $this->iarRepository->getIar($tallyId);

        $report = IarReport::where('iar_id', $iar->id)->first();

        try {
            return new $this->resource($report);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
