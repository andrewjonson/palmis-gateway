<?php

namespace App\Http\Controllers\v1\Transactions;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\v1\Transactions\Rsmi;
use App\Http\Resources\v1\Transactions\RsmiResource;
use App\Repositories\Interfaces\v1\Transactions\RsmiRepositoryInterface;

class RsmiController extends Controller
{
    protected $rules = [];

    public function __construct(
        RsmiRepositoryInterface $rsmiRepository, 
        Request $request
    )
    {
        $this->modelRepository = $rsmiRepository;
        $this->resource = RsmiResource::class;
        $this->modelName = 'Rsmi';

        parent::__construct($request);
    }

    public function store(Request $request)
    {
        $countId = Rsmi::count() + 1;

        $year = Carbon::now()->format('Y');
        $monthDay = Carbon::now()->format('md');
        
        $serial_number = 'RSMI'.'-'.$year.'-'.$monthDay.'-'.sprintf("%04d", $countId);
        $this->modelRepository->create([
            'serial_number' => $serial_number,
            'date' => $request->date,
            'ris_id' => hashid_decode($request->ris_id)
        ]);
        return $this->successResponse('RSMI Created Successfully', DATA_OK);
    }
}
