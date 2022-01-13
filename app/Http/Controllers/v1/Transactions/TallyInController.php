<?php

namespace App\Http\Controllers\v1\Transactions;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\v1\Transactions\TallyIn;
use App\Models\v1\References\DocSetting;
use App\Models\v1\References\SignatoryCo;
use App\Models\v1\Transactions\Inventory;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\Transactions\TallyInResource;
use App\Http\Resources\v1\Transactions\PrintTallyInResource;
use App\Repositories\Interfaces\v1\Transactions\TallyInRepositoryInterface;
use App\Repositories\Interfaces\v1\Reports\TallyInReportRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\InventoryRepositoryInterface;

class TallyInController extends Controller
{
    public function __construct(
        TallyInRepositoryInterface $tallyInRepository,
        InventoryRepositoryInterface $inventoryRepository,
        TallyInReportRepositoryInterface $reportRepository,
        Request $request
    )
    {
        $this->modelRepository = $tallyInRepository;
        $this->inventoryRepository = $inventoryRepository;
        $this->reportRepository = $reportRepository;
        $this->resource = TallyInResource::class;
        $this->tallyInResource = PrintTallyInResource::class;
        $this->modelName = 'TallyIn';

    }

    /** 
     * Bulk Storing of Tally In
     * 
     * @param Illuminate\Http\Request
     * @return Illumninate\Http\JsonResponse
     */
    public function bulkStoreTallyIn(Request $request)
    {
        $tallyIn = $this->createTallyIn($request);
        $tallyInId = $tallyIn->id;

        $tallyInReport = $this->createTallyInReport($request, $tallyInId);

        $dataInventory = $request->inventory;

        $x = 0;
        foreach($dataInventory as $inventory) {
            $totalAmount = $inventory['quantity'] * $inventory['unit_price'];

            $dataInventory[$x]['tally_in_id'] = $tallyInId;
            $dataInventory[$x]['total_amount'] = $totalAmount;
            $dataInventory[$x]['ammunition_nomenclature_id'] = hashid_decode($inventory['ammunition_nomenclature_id']);
            $dataInventory[$x]['manufacturer_id'] = hashid_decode($inventory['manufacturer_id']);
            $dataInventory[$x]['made_id'] = hashid_decode($inventory['made_id']);
            $dataInventory[$x]['condition_id'] = 1;
            $dataInventory[$x]['warehouse_id'] = 1;
            $dataInventory[$x]['temp_balance_qty'] = $inventory['quantity'];

            $totalAmount = 0;
            $x++;
        }

        // bulk insert
        $createTallyIn = $this->inventoryRepository->insert($dataInventory);
        if(!$createTallyIn) {
            return $this->failedResponse(trans('validation.server_error'), SERVER_ERROR);
        }
        
        return $this->successResponse($this->modelName.' Created Successfully', DATA_CREATED);
    }

    /**
     * Storing TallyIn
     * 
     * @param Illuminate\Http\Request
     * @return mixed
     */
    public function createTallyIn(Request $request)
    {
        $countTallyIn = TallyIn::count() + 1;
        
        $year = Carbon::now()->format('Y');
        $monthDay = Carbon::now()->format('md');
        
        $tallyInNumber = 'TLIAM'.'-'.$year.'-'.$monthDay.'-'.sprintf("%04d", $countTallyIn);

        $request->merge([
            'supplier_id' => hashid_decode($request->supplier_id),
            'tally_in_nr' => $tallyInNumber
        ]);

        $dataTallyIn = $request->only([
            'tally_in_nr',
            'tally_in_date',
            'supplier_id',
            'supplier_name',
            'supplier_designation',
            'is_iar',
            'stock_disposition'
        ]);


        $createTallyIn = $this->modelRepository->create($dataTallyIn);

        if(!$createTallyIn) {
            return $this->failedResponse(trans('validation.server_error'), SERVER_ERROR);
        }

        return $createTallyIn;
    }

    /**
     * Get Tally In list
     * 
     * @param Illuminate\Http\Request
     * @return mixed    
     */
    public function getTallyIn(Request $request)
    {
        try {
            $result = $this->modelRepository->getTally($request);
            return $this->resource::collection($result);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Print Tally In Inventory
     * 
     * @param $id
     * @return mixed
     */
    public function printTallyIn($id)
    {
        $id = hashid_decode($id);
        try {
            $result = $this->modelRepository->printTally($id);
            return $this->tallyInResource::collection($result);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Filter Tally
     * 
     * @param Illuminate\Http\Request
     * @return mixed
     */
    public function getFilterTally(Request $request)
    {
        $stock_disposition = $request->stock_disposition;
        $category_id = hashid_decode($request->category_id);
        try {
            $result = $this->modelRepository->filterTally($stock_disposition, $category_id);
            return $this->resource::collection($result);
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
    public function createTallyInReport(Request $request, $id)
    {

        $signatory_co = SignatoryCo::latest()->first();
        $doc_setting = DocSetting::latest()->first();

        $request->merge([
            'tally_in_id' => $id,
            'received_by_signatory_id' => $signatory_co->signatory_id,
            'noted_by_signatory_id' => $signatory_co ? $signatory_co->co_id : null,
            'doc_settings_id' => isset($doc_setting->id) ? $doc_setting->id : null
        ]);

        $dataReport = $request->only([
            'tally_in_id',
            'received_by_signatory_id',
            'noted_by_signatory_id',
            'doc_settings_id'
        ]);

        $createReport = $this->reportRepository->create($dataReport);
        if(!$createReport) {
            return $this->failedResponse(trans('validation.server_error'), SERVER_ERROR);
        }

        return $createReport;
    }

    /**
     * Update Tally In and Inventory
     * 
     * @param Illuminate\Http\Request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $id = hashid_decode($id);
        $data = $this->modelRepository->find($id);
        $in = [];
        $req = [];

        $dataInventory = Inventory::where('tally_in_id', $id)->get();
        $updateInventory = $request->inventory;

        $updateTallyIn = $this->updateTallyIn($request, $id);
        
        try {
            foreach($updateInventory as $update) {
               
                $inventory_id = hashid_decode($update['inventory_id']);
                $ammunition_nomenclature_id = hashid_decode($update['ammunition_nomenclature_id']);
                $manufacturer_id = hashid_decode($update['manufacturer_id']);
                $made_id = hashid_decode($update['made_id']);

                $data = $this->inventoryRepository->find($inventory_id);
                if (!$data) {
                    throw new AuthorizationException;
                }
                
                $data->update([
                    $totalAmount = $update['quantity'] * $update['unit_price'],

                    'ammunition_nomenclature_id' => $ammunition_nomenclature_id,
                    'manufacturer_id' => $manufacturer_id,
                    'lot_number' => $update['lot_number'],
                    'quantity' => $update['quantity'],
                    'date_manufactured' => $update['date_manufactured'],
                    'date_accepted' => $update['date_accepted'],
                    'made_id' => $made_id,
                    'unit_price' => $update['unit_price'],
                    'total_amount' => $totalAmount,
                    'temp_balance_qty' => $update['quantity']
                    // 'condition_id' => $update['condition_id'],
                    // 'warehouse_id' => $update['warehouse_id']
                ]);
            
            }

            foreach($dataInventory as $inventory) {
                array_push($in,$inventory->id);
            }
    
            foreach($updateInventory as $invent) {
                array_push($req,hashid_decode($invent['inventory_id'])); //<--- throw error / handle here
            }
    
    
            $difference = array_diff($in, $req);
            foreach($difference as $diff) {
                $data = $this->inventoryRepository->find($diff);
                // dd($data);
                
                if(!$data) {
                    throw new AuthorizationException;
                }
                $data->delete();
            }
         
            return $this->successResponse($this->modelName.' Updated Successfully', DATA_OK);

        } catch(\Exception $e) {
            if(!array_key_exists('inventory_id', $update)) {
                $totalAmount = $update['quantity'] * $update['unit_price'];

                $this->inventoryRepository->create([
                    'ammunition_nomenclature_id' => hashid_decode($update['ammunition_nomenclature_id']),
                    'tally_in_id' => $id,
                    'total_amount' => $totalAmount,
                    'lot_number' => $update['lot_number'],
                    'quantity' => $update['quantity'],
                    'date_manufactured' => $update['date_manufactured'],
                    'date_accepted' => $update['date_accepted'],
                    'manufacturer_id' => hashid_decode($update['manufacturer_id']),
                    'made_id' => hashid_decode($update['made_id']),
                    'condition_id' => 1,
                    'warehouse_id' => 1,
                    'temp_balance_qty' => $update['quantity']
                ]);
            }
            return $this->successResponse($this->modelName.' Updated Successfully', DATA_OK);
        }
    }

    /**
     * Update Tally In
     * 
     * @param Illuminate\Http\Request
     * @return mixed
     */
    public function updateTallyIn($request, $id)
    {
        $data = $this->modelRepository->find($id);

        if(!$data) {
            throw new AuthorizationException;
        }

        $request->merge([
            'supplier_id' => hashid_decode($request->supplier_id),
        ]);

        $dataTallyIn = $request->only([
            'tally_in_date',
            'supplier_id',
            'supplier_name',
            'supplier_designation',
            'is_iar',
            'stock_disposition'
        ]);

        $updateTallyIn = $data->update($dataTallyIn);

        if(!$updateTallyIn) {
            return $this->failedResponse(trans('validation.server_error'), SERVER_ERROR);
        }

        return $updateTallyIn;
    }

    /**
     * Delete Tally In
     * 
     * @param $id
     * @return mixed
     */
    public function deleteTallyIn($id)
    {
        $id = hashid_decode($id);
        $data = $this->modelRepository->find($id);
        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->delete();
            return $this->successResponse($this->modelName.' Deleted Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
