<?php

namespace App\Http\Controllers\v1\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\Reports\IssuanceDirectiveReportResource;
use App\Repositories\Interfaces\v1\Reports\IssuanceDirectiveReportRepositoryInterface;

class IssuanceDirectiveReportController extends Controller
{
    protected $rules = [];

    public function __construct(
        IssuanceDirectiveReportRepositoryInterface $issuanceDirectiveReportRepository, 
        Request $request
    )
    {
        $this->modelRepository = $issuanceDirectiveReportRepository;
        $this->resource = IssuanceDirectiveReportResource::class;
        $this->modelName = 'IssuanceDirectiveReport';

        parent::__construct($request);
    }

    public function getReportIssuanceDirective($id)
    {
        $issuanceId = hashid_decode($id);
        $data = $this->modelRepository->getModel()->where('issuance_directive_id', $issuanceId)->first();

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
