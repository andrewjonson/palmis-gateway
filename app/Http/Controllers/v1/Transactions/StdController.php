<?php

namespace App\Http\Controllers\v1\Transactions;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\v1\Transactions\Std;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Transactions\StdResource;
use App\Repositories\Interfaces\v1\Transactions\StdRepositoryInterface;

class StdController extends Controller
{
    protected $rules = [];

    public function __construct(
        StdRepositoryInterface $stdRepository, 
        Request $request
    )
    {
        $this->modelRepository = $stdRepository;
        $this->resource = StdResource::class;
        $this->modelName = 'Std';

        parent::__construct($request);
    }

    public function store(Request $request)
    {
        $countStd = Std::count() + 1;

        $year = Carbon::now()->format('Y');
        $monthDay = Carbon::now()->format('md');
        $std_number = 'STD'.'-'.$year.'-'.$monthDay.'-'.sprintf("%04d", $countStd);

        try {
            $request['std_number'] = $std_number;
            $this->modelRepository->create($request->all());
            return $this->successResponse('STD Created Successfully', DATA_CREATED);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
