<?php

namespace App\Http\Controllers\v1\Reports;

use App\Traits\ResponseTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Resources\v1\Reports\TallyInReportResource;
use App\Repositories\Interfaces\v1\Reports\TallyInReportRepositoryInterface;

class TallyInReportController extends BaseController
{
    use ResponseTrait;

    public function __construct(TallyInReportRepositoryInterface $tallyInReportRepository)
    {
        $this->modelRepository = $tallyInReportRepository;
        $this->resource = TallyInReportResource::class;
        $this->modelName = 'TallyIn Report';
    }

    /**
     * Get Repor List
     * 
     * @param Illuminate\Http\Request
     * @return mixed
     */
    public function getReportTallyIn($id)
    {
        $id = hashid_decode($id);
        $data = $this->modelRepository->find($id);

        if(!$data) {
            throw new AuthorizationException;
        }
        try {
            // $data =  $this->modelRepository->getReportTallyIn($request)
            return new $this->resource($data);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
