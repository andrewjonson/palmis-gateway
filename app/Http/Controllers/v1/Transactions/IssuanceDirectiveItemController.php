<?php

namespace App\Http\Controllers\v1\Transactions;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Repositories\Interfaces\v1\Transactions\RisRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\StdItemRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\TallyOutRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\InventoryRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\StockCardRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\StockCardReferenceRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\IssuanceDirectiveItemRepositoryInterface;

class IssuanceDirectiveItemController extends BaseController
{
    use ResponseTrait;

    public function __construct(
        IssuanceDirectiveItemRepositoryInterface $issuanceDirectiveRepository,
        StockCardRepositoryInterface $stockCardRepository,
        InventoryRepositoryInterface $inventoryRepository,
        StockCardReferenceRepositoryInterface $stockCardReferenceRepository,
        StdItemRepositoryInterface $stditemRepository,
        TallyOutRepositoryInterface $tallyoutRepository,
        RisRepositoryInterface $risRepository
    )
    {
        $this->modelRepository = $issuanceDirectiveRepository;
        $this->risRepository = $risRepository;
        $this->stockCardRepository = $stockCardRepository;
        $this->inventoryRepository = $inventoryRepository;
        $this->stockCardReferenceRepository = $stockCardReferenceRepository;
        $this->stditemRepository = $stditemRepository;
        $this->tallyoutRepository = $tallyoutRepository;
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
        // $risData = $this->risRepository->update([
        //     'entity_name' => $request->entity_name,
        //     'fund_cluster_id' => hashid_decode($request->fund_cluster_id),
        //     'responsibility_center_code_id' => hashid_decode($request->responsibility_center_code_id)
        // ], $risId);

        $risData = $this->risRepository->find($risId);
        
        try {
            $updateItem = $request->issuance_directive_item;
            // return $updateItem;
            // for bulk update of inventory
                foreach($updateItem as $update) {
                    $id = hashid_decode($update['id']);
                    $data = $this->modelRepository->find($id);
                    if ($request->is_std) {
                        $data = $this->stditemRepository->find($id);
                    }

                    if (!$data) {
                        throw new AuthorizationException;
                    }

                    $data->update(['remarks' => $update['remarks']]);

                    $stockCardId = $data->stock_card_id;
                    $stockCard = $this->stockCardRepository->find($stockCardId);
                    $inventoryId = $stockCard->inventory_id;
                    $inventory = $this->inventoryRepository->find($inventoryId);

                    $tallyout = $this->tallyoutRepository
                                ->create([
                                    'ris_id' => $risId,
                                    'issuance_directive_item_id' => hashid_decode($update['id']),
                                    'unservisable' => false
                                ]);

                    $stockCardReference = $this->stockCardReferenceRepository
                                            ->create([
                                                'stock_card_id' => $stockCardId,
                                                'reference' => $risData->ris_nr,
                                                'office' => $data->std ? $data->std->iar->entity_name : $data->issuanceDirective->iar->entity_name,
                                                'ris_id' => $risId,
                                                'date' => $risData->updated_at,
                                                'balance' => $inventory->temp_balance_qty,
                                                'quantity' => $data->quantity
                                            ]);
                    
                    $dataInventory = $inventory->update(['quantity' => $inventory->temp_balance_qty]);
                }
                $ris = $risData->update(['status' => true]);
    
            return $this->successResponse($this->modelName.' Updated Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
