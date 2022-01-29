<?php

namespace App\Http\Controllers\v1\Transactions;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Repositories\Interfaces\v1\Transactions\RisRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\InventoryRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\StockCardRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\IssuanceDirectiveItemRepositoryInterface;

class IssuanceDirectiveItemController extends BaseController
{
    use ResponseTrait;

    public function __construct(
        IssuanceDirectiveItemRepositoryInterface $issuanceDirectiveRepository,
        StockCardRepositoryInterface $stockCardRepository,
        InventoryRepositoryInterface $inventoryRepository,
        RisRepositoryInterface $risRepository
    )
    {
        $this->modelRepository = $issuanceDirectiveRepository;
        $this->risRepository = $risRepository;
        $this->stockCardRepository = $stockCardRepository;
        $this->inventoryRepository = $inventoryRepository;
        $this->modelName = 'Issuance Directive Item';
    }

    /**
     * Update Issuance Directive Item
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\JsonResponse
     */
    public function updateIdItem(Request $request)
    {
        $risId = hashid_decode($request->ris_id);
        $risData = $this->risRepository->update([
            'entity_name' => $request->entity_name,
            'fund_cluster_id' => hashid_decode($request->fund_cluster_id),
            'responsibility_center_code_id' => hashid_decode($request->responsibility_center_code_id)
        ], $risId);
        
        try {
            $updateItem = $request->issuance_directive_item;

            // for bulk update of inventory
                foreach($updateItem as $update) {
                    $id = hashid_decode($update['id']);
                    $data = $this->modelRepository->find($id);
                    
                    if (!$data) {
                        throw new AuthorizationException;
                    }
                    $data->update(['remarks' => $update['remarks']]);

                    $stockCardId = $data->stock_card_id;
                    $stockCard = $this->stockCardRepository->find($stockCardId);
                    $inventoryId = $stockCard->inventory_id;
                    $inventory = $this->inventoryRepository->find($inventoryId);
                    
                    $dataInventory = $inventory->update(['quantity' => $inventory->temp_balance_qty]);
                }
                $ris = $risData->update(['status' => true]);
    
            return $this->successResponse($this->modelName.' Updated Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
