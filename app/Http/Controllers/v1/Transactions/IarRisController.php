<?php

namespace App\Http\Controllers\v1\Transactions;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\Transactions\IarRisRepositoryInterface;
use App\Http\Resources\v1\Transactions\IarRisResource;
use Illuminate\Http\Request;

class IarRisController extends Controller
{
    protected $rules = [];

    public function __construct(
        IarRisRepositoryInterface $iarRisRepository, 
        Request $request
    )
    {
        $this->modelRepository = $iarRisRepository;
        $this->resource = IarRisResource::class;
        $this->modelName = 'IarRis';

        parent::__construct($request);
    }

    public function getIarRis(Request $request)
    {
        $stockCardId = hashid_decode($request->stock_card_id);
        try {
            $results = $this->modelRepository
                            ->getModel()
                            ->where('stock_card_id', $stockCardId)
                            ->get();
            return $this->resource::collection($results);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
