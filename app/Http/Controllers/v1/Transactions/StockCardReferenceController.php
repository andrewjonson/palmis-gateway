<?php

namespace App\Http\Controllers\v1\Transactions;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\Transactions\StockCardReferenceRepositoryInterface;
use App\Http\Resources\v1\Transactions\StockCardReferenceResource;
use Illuminate\Http\Request;

class StockCardReferenceController extends Controller
{
    protected $rules = [];

    public function __construct(
        StockCardReferenceRepositoryInterface $stockCardReferenceRepository, 
        Request $request
    )
    {
        $this->modelRepository = $stockCardReferenceRepository;
        $this->resource = StockCardReferenceResource::class;
        $this->modelName = 'StockCardReference';

        parent::__construct($request);
    }

    public function getStockCardReference(Request $request)
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
