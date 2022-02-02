<?php

namespace App\Http\Controllers\v1\Transactions;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\v1\Transactions\Ptis;
use App\Http\Resources\v1\Transactions\PtisResource;
use App\Repositories\Interfaces\v1\Transactions\PtisRepositoryInterface;

class PtisController extends Controller
{
    protected $rules = [];

    public function __construct(
        PtisRepositoryInterface $ptisRepository, 
        PtisItemRepositoryInterface $ptisitemRepository,
        Request $request
    )
    {
        $this->modelRepository = $ptisRepository;
        $this->ptisitemRepository = $ptisitemRepository;
        $this->resource = PtisResource::class;
        $this->modelName = 'Ptis';

        parent::__construct($request);
    }

    public function createPtis(Request $request)
    {
        $countPtis = Ptis::count() + 1;

        $year = Carbon::now()->format('Y');
        $monthDay = Carbon::now()->format('md');
        
        $ptisNr = 'PTIS'.'-'.$year.'-'.$monthDay.'-'.sprintf("%04d", $countPtis);

        try {
            $items = $request->items;
            $ptis = $this->modelRepository->create([
                'to' => $request->to,
                'from' => $request->from,
                'turn_in_slip_nr' => $ptisNr,
                'basis' => $request->basis,
                'remarks' => $request->remarks
            ]);

            foreach ($items as $item) {
                $ptis_item = $this->ptisitemRepository->create([
                    'pts_id' => $ptis->id,
                    'lot_nr' => $item['lot_nr'],
                    'quantity' => $item['quantity'],
                    'remarks' => $item['remarks']
                ]);
            }
            return $this->successResponse($this->modelName.' Created Successfully', DATA_CREATED);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
