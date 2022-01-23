<?php

namespace App\Http\Controllers\v1\Transactions;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\Transactions\TallyOutRepositoryInterface;
use App\Http\Resources\v1\Transactions\TallyOutResource;
use Illuminate\Http\Request;

class TallyOutController extends Controller
{
    protected $rules = [];

    public function __construct(
        TallyOutRepositoryInterface $tallyOutRepository, 
        Request $request
    )
    {
        $this->modelRepository = $tallyOutRepository;
        $this->resource = TallyOutResource::class;
        $this->modelName = 'TallyOut';

        parent::__construct($request);
    }

    public function getTallyOutReport(Request $request, $id) 
    {
        $id = hashid_decode($id);
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $results = $this->modelRepository
                    ->getModel()
                    ->where('ris_id', $id)
                    ->get();

            return $this->resource::collection($results);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
