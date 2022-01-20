<?php

namespace App\Http\Controllers\v1\Transactions;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Laravel\Lumen\Routing\Controller;
use App\Repositories\Interfaces\v1\Transactions\StdItemRepositoryInterface;

class StdItemController extends Controller
{
    use ResponseTrait;

    public function __construct(
        StdItemRepositoryInterface $stdItemRepository, 
        Request $request
    )
    {
        $this->modelRepository = $stdItemRepository;
    }

    public function createStdItem(Request $request, $stdId)
    {
        try {
            $inventoryId = hashid_decode($request->inventory_id);
            $stdId = hashid_decode($stdId);
            $cognizantFpaoId = hashid_decode($request->cognizant_fpao_id);
            $receivingFpaoId = hashid_decode($request->receiving_fpao_id);
            $cognizantFssuId = hashid_decode($request->cognizant_fssu_id);
            $receivingFssuId = hashid_decode($request->receiving_fssu_id);

            $this->modelRepository->create([
                'std_id' => $stdId,
                'inventory_id' => $inventoryId,
                'cognizant_fpao_id' => $cognizantFpaoId,
                'receiving_fpao_id' => $receivingFpaoId,
                'cognizant_fssu_id' => $cognizantFssuId,
                'receiving_fssu_id' => $receivingFssuId
            ]);

            return $this->successResponse('STD Item Created Successfully', DATA_CREATED);
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
