<?php

namespace App\Http\Controllers\v1\Transactions;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\v1\Transactions\Ris;
use App\Models\v1\References\DocSetting;
use App\Models\v1\References\SignatoryCo;
use App\Models\v1\Transactions\StockCard;
use App\Models\v1\Transactions\IssuanceDirective;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\v1\Transactions\IssuanceDirectiveItem;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Resources\v1\Transactions\TallyOutResource;
use App\Http\Resources\v1\Transactions\IssuanceDirectiveResource;
use App\Repositories\Interfaces\v1\Transactions\RisRepositoryInterface;
// use App\Repositories\Interfaces\v1\Transactions\TallyOutRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\InventoryRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\IssuanceDirectiveRepositoryInterface;
use App\Repositories\Interfaces\v1\Reports\IssuanceDirectiveReportRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\IssuanceDirectiveItemRepositoryInterface;

class IssuanceDirectiveController extends BaseController
{
    use ResponseTrait;

    public function __construct(
        IssuanceDirectiveRepositoryInterface $idRepository, 
        IssuanceDirectiveItemRepositoryInterface $idItemRepository,
        InventoryRepositoryInterface $inventoryRespository, 
        IssuanceDirectiveReportRepositoryInterface $reportRepository,
        RisRepositoryInterface $risRepository,
        // TallyOutRepositoryInterface $tallyoutRepository
    )
    {
        $this->modelRepository = $idRepository;
        $this->idItemRepository = $idItemRepository;
        $this->inventoryRespository = $inventoryRespository;
        $this->reportRepository = $reportRepository;
        $this->risRepository = $risRepository;
        // $this->tallyoutRepository = $tallyoutRepository;
        $this->modelName = 'Issuance Directive';
        $this->idModelName = 'Issuance Directive Item';
        $this->resource = IssuanceDirectiveResource::class;
        // $this->tallyOutResource = TallyOutResource::class;
    }

    /**
     * Store Issuance Directive
     */
    public function bulkStore(Request $request)
    {
        $issuance = $this->createIssuanceDirective($request);
        
        $issuanceId = $issuance->id;

        $idReport = $this->createIssuanceDirectiveReport($request, $issuanceId);

        $ris = $this->createRis($request, $issuanceId);

        // $risId = $ris->id;

        // $tallyOut = $this->createTallyOut($request, $risid);

        $issuanceDirectiveId = hashid_encode($issuanceId);

        return $this->successResponse($this->modelName.' Created Successfully', DATA_CREATED);
    }

    public function createItem(Request $request)
    {
        $stockCard = hashid_decode($request->stock_card_id);
        $issuanceDirectiveId = hashid_decode($request->issuance_directive_id);
        try {
            $inventory = StockCard::join('tr_inventories', 'tr_inventories.id', '=', 'tr_stock_cards.inventory_id')
                                    ->where('tr_stock_cards.id', $stockCard)
                                    ->first();

            if(!$inventory) {
                throw new AuthorizationException;
            }

            $temp = $inventory->temp_balance_qty - $request->quantity;

            if ($temp >= 0) {
                $this->idItemRepository->create([
                    'issuance_directive_id' => $issuanceDirectiveId,
                    'stock_card_id' => $stockCard,
                    'quantity' => $request->quantity
                ]);
    
                $updateInventory = $this->inventoryRespository->update([
                    'temp_balance_qty' => $temp
                ], $inventory->id);
                return $this->successResponse($this->idModelName.' Created Successfully', DATA_CREATED);
            } else {
                return $this->failedResponse('Out of Stocks!', SERVER_ERROR);
            }
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function updateIssuanceDirective(Request $request, $id)
    {
        $id = hashid_decode($id);
        $data = $this->modelRepository->find($id);
        if (!$data) {
            throw new AuthorizationException;
        }

        // $this->validateRequest($request, $id);
        try {
            $data->update([
                'authority' => $request->authority,
                'pamu_id' => hashid_decode($request->pamu_id),
                'end_user_id' => hashid_decode($request->end_user_id),
                'cognizant_fpao_id' => hashid_decode($request->cognizant_fpao_id),
                'cognizant_fssu_id' => hashid_decode($request->cognizant_fssu_id),
                'servicing_fpao_id' => hashid_decode($request->servicing_fpao_id),
                'date' => $request->date,
                'issuance_directive_purpose_id' => hashid_decode($request->issuance_directive_purpose_id),
                'issuance_directive_condition_id' => hashid_decode($request->issuance_directive_condition_id)
            ], $id);

            return $this->successResponse($this->modelName.' Updated Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function deleteIssuanceDirective($id)
    {
        $id = hashid_decode($id);
       
        $data = $this->modelRepository->find($id);

        $items = IssuanceDirectiveItem::select('tr_issuance_directive_items.quantity as quantity', 'tr_issuance_directive_items.id as item_id', 'temp_balance_qty', 'tr_inventories.id as inventory_id')
                                    ->join('tr_stock_cards', 'tr_stock_cards.id', '=', 'tr_issuance_directive_items.stock_card_id')
                                    ->join('tr_inventories', 'tr_inventories.id', '=', 'tr_stock_cards.inventory_id')
                                    ->where('tr_issuance_directive_items.issuance_directive_id', $id)
                                    ->get();

        foreach ($items as $item) {
            $temp = $item['temp_balance_qty'] + $item['quantity'];

            $updateInventory = $this->inventoryRespository->update([
                'temp_balance_qty' => $temp
            ], $item['inventory_id']);

            $item = $this->idItemRepository->find($item['item_id']);
            $item->forceDelete();
        }

        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->forceDelete();
            return $this->successResponse($this->modelName.' Permanently Deleted Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function deleteItem($id)
    {
        $id = hashid_decode($id);
        $inventory = IssuanceDirectiveItem::select('tr_issuance_directive_items.quantity as quantity', 'tr_inventories.id as id', 'temp_balance_qty')
                                    ->join('tr_stock_cards', 'tr_stock_cards.id', '=', 'tr_issuance_directive_items.stock_card_id')
                                    ->join('tr_inventories', 'tr_inventories.id', '=', 'tr_stock_cards.inventory_id')
                                    ->where('tr_issuance_directive_items.id', $id)
                                    ->first();
        $temp = $inventory->temp_balance_qty + $inventory->quantity;

        $updateInventory = $this->inventoryRespository->update([
            'temp_balance_qty' => $temp
        ], $inventory->id);

        $data = $this->idItemRepository->find($id);
        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->forceDelete();
            return $this->successResponse($this->idModelName.' Permanently Deleted Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Create Issuance Directive
     */
    public function createIssuanceDirective(Request $request)
    {
        $countId = IssuanceDirective::count() + 1;

        $year = Carbon::now()->format('Y');
        $monthDay = Carbon::now()->format('md');
        
        $idNr = 'IDAAM'.'-'.$year.'-'.$monthDay.'-'.sprintf("%04d", $countId);

        $request->merge([
            'issuance_directive_nr' => $idNr,
            'pamu_id' => hashid_decode($request->pamu_id),
            'end_user_id' => hashid_decode($request->end_user_id),
            'cognizant_fpao_id' => hashid_decode($request->cognizant_fpao_id),
            'cognizant_fssu_id' => hashid_decode($request->cognizant_fssu_id),
            'servicing_fpao_id' => hashid_decode($request->servicing_fpao_id),
            'issuance_directive_purpose_id' => hashid_decode($request->issuance_directive_purpose_id),
            'issuance_directive_condition_id' => hashid_decode($request->issuance_directive_condition_id)
        ]);

        try {
            $dataId = $request->only([
                'issuance_directive_nr',
                'authority',
                'pamu_id',
                'cognizant_fpao_id',
                'cognizant_fssu_id',
                'servicing_fpao_id',
                'date',
                'end_user_id',
                'issuance_directive_purpose_id',
                'issuance_directive_condition_id'
            ]);

            $result = $this->modelRepository->create($dataId);
            return $result;
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Create RIS
     */

    public function createRis(Request $request, $id)
    {
        $countRis = Ris::count() + 1;
        
        $year = Carbon::now()->format('Y');
        $monthDay = Carbon::now()->format('md');
        
        $risNumber = 'RISAM'.'-'.$year.'-'.$monthDay.'-'.sprintf("%04d", $countRis);

        $request->merge([
            'issuance_directive_id' => $id,
            'ris_nr' => $risNumber
        ]);

        $dataRis = $request->only([
            'issuance_directive_id',
            'ris_nr',
            'status'
        ]);

        $createRis = $this->risRepository->create($dataRis);

        if(!$createRis) {
            return $this->failedResponse(trans('validation.server_error'), SERVER_ERROR);
        }

        return $createRis;
    }

    /**
     * Create Tally Out
     */

    //  public function createTallyOut(Request $request, $risId) 
    //  {
    //     $request->merge([
    //         'ris_id' => $risId,
    //         'unservisable' => 'false'
    //     ]);

    //     $dataTallyOut = $request->only([
    //         'ris_id',
    //         'unservisable'
    //     ]);

    //     $createTallyOut = $this->tallyoutRepository->create($dataTallyOut);

    //     if(!$createTallyOut) {
    //         return $this->failedResponse(trans('validation.server_error'), SERVER_ERROR);
    //     }

    //     return $createTallyOut;
    //  }

    /**
     * Get List of Issuance Directive
     * 
     * @param Illuminate\Http\Request
     * @return mixed
     */
    public function getIssuanceDirective(Request $request)
    {
        try {
            $result = $this->modelRepository->paginate();
            return $this->resource::collection($result);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Get Issuance Directive by Id
     * 
     * @param $id
     * @return mixed
     */
    public function getIssuanceById($id)
    {
        $id = hashid_decode($id);

        try {
            $data = $this->modelRepository->find($id);
            if (!$data) {
                throw new AuthorizationException;
            }
            return new $this->resource($data);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function createIssuanceDirectiveReport(Request $request, $id)
    {

        $signatory_co = SignatoryCo::latest()->first();
        $doc_setting = DocSetting::latest()->first();

        $request->merge([
            'issuance_directive_id' => $id,
            'prepared_by_id' => $signatory_co ? $signatory_co->signatory_id : null,
            'approved_by_id' => $signatory_co ? $signatory_co->co_id : null,
            'doc_setting_id' => $doc_setting ? $doc_setting->id : null
        ]);

        $dataReport = $request->only([
            'issuance_directive_id',
            'prepared_by_id',
            'approved_by_id',
            'doc_setting_id'
        ]);

        $createReport = $this->reportRepository->create($dataReport);
        if(!$createReport) {
            return $this->failedResponse(trans('validation.server_error'), SERVER_ERROR);
        }

        return $createReport;
    }
}
