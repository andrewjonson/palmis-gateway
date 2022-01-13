<?php

namespace App\Http\Controllers\v1\Transactions;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\Transactions\InventoryResource;
use App\Http\Resources\v1\Transactions\LotNumberResource;
use App\Repositories\Interfaces\v1\Transactions\InventoryRepositoryInterface;

class InventoryController extends Controller
{
    use ResponseTrait;

    public function __construct(InventoryRepositoryInterface $inventoryRepository)
    {
        $this->modelRepository = $inventoryRepository;
        $this->resource = InventoryResource::class;
        $this->lotNrResource = LotNumberResource::class;
        $this->modelName = 'Inventory';
    }

    public function get(Request $request)
    {
        try {
            $result = $this->modelRepository->getInventory($request);
            return $this->resource::collection($result);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Search Lot Number
     * 
     * @param
     * @return mixed
     */
    public function searchLotNr(Request $request)
    {
        $lotNr = $request->lot_number;
        try {
            $data = $this->modelRepository->searchLotNr($lotNr);
            return $this->lotNrResource::collection($data);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
