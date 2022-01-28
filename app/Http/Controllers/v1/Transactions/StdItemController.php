<?php

namespace App\Http\Controllers\v1\Transactions;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Laravel\Lumen\Routing\Controller;
use App\Models\v1\Transactions\Inventory;
use Illuminate\Auth\Access\AuthorizationException;
use App\Repositories\Interfaces\v1\Transactions\StdItemRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\InventoryRepositoryInterface;

class StdItemController extends Controller
{
    use ResponseTrait;

    public function __construct(
        StdItemRepositoryInterface $stdItemRepository, 
        InventoryRepositoryInterface $inventoryRespository,
        Request $request
    )
    {
        $this->modelRepository = $stdItemRepository;
        $this->inventoryRespository = $inventoryRespository;
    }

    public function createStdItem(Request $request, $stdId)
    {
        $inventoryId = hashid_decode($request->inventory_id);
        $stdId = hashid_decode($stdId);
        $cognizantFpaoId = hashid_decode($request->cognizant_fpao_id);
        $receivingFpaoId = hashid_decode($request->receiving_fpao_id);
        $cognizantFssuId = hashid_decode($request->cognizant_fssu_id);
        $receivingFssuId = hashid_decode($request->receiving_fssu_id);

        $stockCard = hashid_decode($request->stock_card_id);
        try {
            $inventory = Inventory::whereHas('stockCard', function($query) use($stockCard) {
                $query->where('id', $stockCard);
            })->first();

            if(!$inventory) {
                throw new AuthorizationException;
            }

            $temp = $inventory->temp_balance_qty - $request->quantity;
            
            if ($temp >= 0) {
                $this->modelRepository->create([
                    'std_id' => $stdId,
                    'stock_card_id' => $stockCard,
                    'cognizant_fpao_id' => $cognizantFpaoId,
                    'receiving_fpao_id' => $receivingFpaoId,
                    'cognizant_fssu_id' => $cognizantFssuId,
                    'receiving_fssu_id' => $receivingFssuId,
                    'quantity' => $request->quantity
                ]);

                $updateInventory = $this->inventoryRespository->update([
                    'temp_balance_qty' => $temp
                ], $inventory->id);
                return $this->successResponse('STD Item Created Successfully', DATA_CREATED);
            }
            return $this->failedResponse('Out of Stocks!', SERVER_ERROR);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function deleteStdItem($stdItemId)
    {
        try {
            $stdItemId = hashid_decode($stdItemId);
            $stdItem = $this->modelRepository->find($stdItemId);
            $stdItem->delete();
            return $this->successResponse('STD Item Deleted Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
