<?php

namespace App\Http\Controllers\v1\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\Reports\StockCardReportResource;
use App\Repositories\Interfaces\v1\Transactions\StockCardRepositoryInterface;
use App\Repositories\Interfaces\v1\Reports\StockCardReportRepositoryInterface;

class StockCardReportController extends Controller
{
    protected $rules = [];

    public function __construct(
        StockCardReportRepositoryInterface $stockCardReportRepository, 
        StockCardRepositoryInterface $stockcardRepository,
        Request $request
    )
    {
        $this->modelRepository = $stockCardReportRepository;
        $this->stockCardRepository = $stockcardRepository;
        $this->resource = StockCardReportResource::class;
        $this->modelName = 'StockCardReport';

        parent::__construct($request);
    }

    public function getReportStockCard($id)
    {
        $stockCardId = hashid_decode($id);
        $data = $this->modelRepository->getModel()->where('stock_card_id', $stockCardId)->first();

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
