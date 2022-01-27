<?php

namespace App\Http\Controllers\v1\Transactions;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\Transactions\RisResource;
use App\Http\Resources\v1\Transactions\RisItemResource;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Resources\v1\Transactions\RisIdItemResource;
use App\Repositories\Interfaces\v1\Transactions\RisRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\IarRisRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\TallyOutRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\InventoryRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\StockCardRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\IssuanceDirectiveRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\IssuanceDirectiveItemRepositoryInterface;

class RisController extends BaseController
{
    use ResponseTrait;

    public function __construct(
        RisRepositoryInterface $risRepository,
        IssuanceDirectiveItemRepositoryInterface $directiveitemRepository,
        IssuanceDirectiveRepositoryInterface $issuanceDirectiveRepository,
        TallyOutRepositoryInterface $tallyoutRepository,
        StockCardRepositoryInterface $stockcardRepository,
        InventoryRepositoryInterface $inventoryRepository,
        IarRisRepositoryInterface $iarrisRepository
        )
    {
        $this->modelRepository = $risRepository;
        $this->directiveitemRepository = $directiveitemRepository;
        $this->issuanceDirective = $issuanceDirectiveRepository;
        $this->tallyoutRepository = $tallyoutRepository;
        $this->stockcardRepository = $stockcardRepository;
        $this->inventoryRepository = $inventoryRepository;
        $this->iarrisRepository = $iarrisRepository;
        $this->modelName = 'RIS';
        $this->resource = RisResource::class;
        $this->risIdItemResource = RisIdItemResource::class;
        $this->risItemResource = RisItemResource::class;
    }

    public function updateDirectiveItems(Request $request)
    {
        
        $risId = hashid_decode($request->ris_id);
        $data = $this->modelRepository->find($risId);

        $issuanceDirective = $this->issuanceDirective->find($data->issuance_directive_id);

        $dataDirective = $request->issuance_directive_item;
        foreach ($dataDirective as $item) {
            $itemIssuance = $this->directiveitemRepository
                            ->getModel()
                            ->where('id', hashid_decode($item['id']))
                            ->first();

            $directiveItem = $this->directiveitemRepository
                    ->update([
                        'remarks' => $item['remarks'],
                    ], hashid_decode($item['id']));

            $tallyout = $this->tallyoutRepository
                    ->create([
                        'ris_id' => $risId,
                        'issuance_directive_item_id' => hashid_decode($item['id']),
                        'unservisable' => $item['unservisable']
                    ]);

            $stockCardId = $directiveItem->stock_card_id;
            $stockCard = $this->stockcardRepository->find($stockCardId);
            $inventoryId = $stockCard->inventory_id;
            $inventory = $this->inventoryRepository->find($inventoryId);
            
            $quantity = $inventory->quantity;
            $balance = $inventory->temp_balance_qty;
            $total = $quantity - $itemIssuance->quantity;
            
            $dataInventory = $inventory->update(['quantity' => $total]);

            $airRis = $this->iarrisRepository
                    ->create([
                        'stock_card_id' => $stockCardId,
                        'reference' => $data->ris_nr
                    ]);
        }
        $ris = $data->update(['status' => true]);
        $issuance_directive = $issuanceDirective->update(['is_released' => true]);

        return $this->successResponse($this->modelName.' Created Successfully', DATA_CREATED);
    }

    /**
     * Get List of RIS
     * 
     * @param Illuminate\Http\Request
     * @return mixed
     */
    public function getRisList(Request $request)
    {
        try {
            $data = $this->modelRepository->paginate();
            return $this->risIdItemResource::collection($data);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Get List By RIS Id
     * 
     * @param $id
     * @return mixed
     */
    public function getRisById($id)
    {
        $id = hashid_decode($id);
        $data = $this->modelRepository->find($id);
        
        if(!$data) {
            throw new AuthorizationException;
        }

        try {
            $checkStatus = $data->status;

            if($checkStatus == true) {
                return new $this->risIdItemResource($data);
            }
            return new $this->risIdItemResource($data);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
