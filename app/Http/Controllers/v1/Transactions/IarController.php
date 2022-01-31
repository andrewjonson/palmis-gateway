<?php

namespace App\Http\Controllers\v1\Transactions;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\v1\Transactions\Iar;
use App\Http\Controllers\Controller;
use App\Models\v1\References\DocSetting;
use App\Models\v1\References\SignatoryCo;
use App\Models\v1\Transactions\Inventory;
use App\Models\v1\Transactions\StockCard;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\Transactions\IarResource;
use App\Http\Resources\v1\Transactions\RpciResource;
use App\Http\Resources\v1\Transactions\InventoryResource;
use App\Http\Resources\v1\Transactions\TallyInInventoryResource;
use App\Repositories\Interfaces\v1\Transactions\IarRepositoryInterface;
use App\Repositories\Interfaces\v1\Reports\IarReportRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\TallyInRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\InventoryRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\StockCardRepositoryInterface;
use App\Repositories\Interfaces\v1\Reports\StockCardReportRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\StockCardReferenceRepositoryInterface;

class IarController extends Controller
{
    use ResponseTrait;

    public function __construct(
        IarRepositoryInterface $iarRepository,
        InventoryRepositoryInterface $inventoryRepository,
        StockCardRepositoryInterface $stockCardRepository,
        TallyInRepositoryInterface $tallyInRepository,
        IarReportRepositoryInterface $reportRepository,
        StockCardReportRepositoryInterface $stockcardreportRepository,
        StockCardReferenceRepositoryInterface $stockCardReferenceRepository,
        Request $request
    )
    {
        $this->modelRepository = $iarRepository;
        $this->inventoryRepository = $inventoryRepository;
        $this->stockCardRepository = $stockCardRepository;
        $this->tallyInRepository = $tallyInRepository;
        $this->reportRepository = $reportRepository;
        $this->stockcardreportRepository = $stockcardreportRepository;
        $this->stockCardReferenceRepository = $stockCardReferenceRepository;
        $this->inventoryResource = InventoryResource::class;
        $this->resource = IarResource::class;
        $this->tallyInInventoryResource = TallyInInventoryResource::class;
        $this->modelName = 'IAR';
    }

    /**
     * Create IAR (Inventory Acceptance Report)
     * 
     * @param Illuminate\Http\Request
     * @param $id
     * @return Illuminate\Http\JsonResponse
     */
    public function create(Request $request, $id)
    {
        $id = hashid_decode($id);
        //for creating IAR
        $iar = $this->createIar($request, $id);
        $iarId = $iar->id;

        $iarReport = $this->createIarReport($request, $iarId);
        
        // for update is_route in tally in
        $this->updateTallyInIsRoute($id);

        $updateInventory = $request->updateInventory;

        try {
            // for bulk update of inventory
                foreach($updateInventory as $update) {
                    $inventory_id = hashid_decode($update['inventory_id']);

                    // create stock card
                    $stockCard = $this->createStockCard($request, $iarId, $inventory_id);
                    
                    $stockCardId = $stockCard->id;

                    $airRis = $this->stockCardReferenceRepository
                                ->create([
                                    'stock_card_id' => $stockCardId,
                                    'reference' => $iar->iar_nr,
                                    'office' => $iar->entity_name,
                                    'iar_id' => $iarId
                                ]);

                    $stockCardReport = $this->createStockCardReport($request, $stockCardId);

                    $data = $this->inventoryRepository->find($inventory_id);
                    if (!$data) {
                        throw new AuthorizationException;
                    }
                    $data->update(['is_accepted' => $update['is_accepted']]);
                }
    
            return $this->successResponse($this->modelName.' Updated Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Create Iar
     * 
     * @param Illuminate\Http\Request
     * @param $id
     * @return mixed
     */
    public function createIar(Request $request, $id)
    {
        $countIar = Iar::count() + 1;

        $year = Carbon::now()->format('Y');
        $monthDay = Carbon::now()->format('md');
        
        $iarNr = 'IARAM'.'-'.$year.'-'.$monthDay.'-'.sprintf("%04d", $countIar);

        $request->merge([
            'iar_nr' => $iarNr,
            'tally_in_id' => $id,
            'fund_cluster_id' => hashid_decode($request->fund_cluster_id),
            'requisitioning_office_id' => hashid_decode($request->requisitioning_office_id),
            'responsibility_center_code_id' => hashid_decode($request->responsibility_center_code_id)
        ]);

        $dataIar = $request->only([
            'tally_in_id',
            'iar_nr',
            'entity_name',
            'date',
            'po_nr',
            'fund_cluster_id',
            'invoice_nr',
            'invoice_date',
            'requisitioning_office_id',
            'responsibility_center_code_id',
            'accountable_officer',
            'officer_designation'
        ]);

        $createIar = $this->modelRepository->create($dataIar);
        if(!$createIar) {
            return $this->failedResponse('server_error', SERVER_ERROR);
        }

        return $createIar;
    }

    /**
     * Create Stock Card
     * 
     * @param Illuminate\Http\Request
     * @param $id
     * @return mixed
     */
    public function createStockCard(Request $request, $id)
    {
        $countStockCard = StockCard::count() + 1;

        $year = Carbon::now()->format('Y');
        $monthDay = Carbon::now()->format('md');
        
        $stockCardNr = 'SCAAM'.'-'.$year.'-'.$monthDay.'-'.sprintf("%04d", $countStockCard);

        $request->merge([
            'inventory_id' => $id,
            'stock_card_nr' => $stockCardNr
        ]);

        try {
            $dataStockCard = $request->only([
                'inventory_id',
                'stock_card_nr'
            ]);

        $createStockCard = $this->stockCardRepository->create($dataStockCard);

        return $createStockCard;

        }catch(\Exception $e) {
            $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Get Tally In by Id
     * 
     * @param $id
     * @return mixed
     */
    public function getInventoryByTallyId($id)
    {
        $id = hashid_decode($id);

        try {
            $result = $this->inventoryRepository->getTallyId($id);
            return $this->inventoryResource::collection($result);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * For Update Tally In is_router column
     * 
     * @param $id
     * @return mixed
     */
    public function updateTallyInIsRoute($id)
    {
        $data = $this->tallyInRepository->find($id);
        if (!$data) {
            throw new AuthorizationException;
        }
        try {
            $updateIsRoute = $data->update(['is_iar' => true]);
            return $updateIsRoute;
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * get Supplier and Inventories data by tallyIn id
     * 
     * @param
     * 
     */
    public function getByTallyId($id)
    {
        $id = hashid_decode($id);

        try {
            $result = $this->modelRepository->getByTallyId($id);
            $checkIsIar = $result->is_iar;

            if($checkIsIar == true) {
                $result = $this->modelRepository->getIar($id);
                return new $this->resource($result);
            }
            return new $this->tallyInInventoryResource($result);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Create Tally In Reports
     * 
     * @param Illuminate\Http\Request
     * @return mixed
     */
    public function createIarReport(Request $request, $id)
    {

        $signatory_co = SignatoryCo::latest()->first();
        $doc_setting = DocSetting::latest()->first();

        $request->merge([
            'iar_id' => $id,
            'acceptance_signatory_id' => $signatory_co->signatory_id,
            'inspection_signatory_id' => $signatory_co->co_id,
            'doc_settings_id' => isset($doc_setting->id) ? $doc_setting->id : null
        ]);

        $dataReport = $request->only([
            'iar_id',
            'doc_settings_id',
            'acceptance_signatory_id',
            'inspection_signatory_id'
        ]);

        $createReport = $this->reportRepository->create($dataReport);
        if(!$createReport) {
            return $this->failedResponse(trans('validation.server_error'), SERVER_ERROR);
        }

        return $createReport;
    }

    public function createStockCardReport(Request $request, $id)
    {

        $signatory_co = SignatoryCo::latest()->first();
        $doc_setting = DocSetting::latest()->first();

        $request->merge([
            'stock_card_id' => $id,
            'received_from_id' => $signatory_co->signatory_id,
            'received_by_id' => $signatory_co->co_id,
            'doc_setting_id' => isset($doc_setting->id) ? $doc_setting->id : null
        ]);

        $dataReport = $request->only([
            'stock_card_id',
            'doc_setting_id',
            'received_from_id',
            'received_by_id'
        ]);

        $createStockCardReport = $this->stockcardreportRepository->create($dataReport);
        if(!$createStockCardReport) {
            return $this->failedResponse(trans('validation.server_error'), SERVER_ERROR);
        }

        return $createStockCardReport;
    }
    
    /**
     * Get Iar List
     * 
     * @param Illuminate\Http\Request
     * @return mixed
     */
    public function getIarList(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $data = $this->modelRepository->search($keyword, $rowsPerPage);
            return $this->resource::collection($data);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
    
    public function getRpci($id)
    {
        try {
            $id = hashid_decode($id);
            $iar = $this->modelRepository->find($id);
            return new RpciResource($iar);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
