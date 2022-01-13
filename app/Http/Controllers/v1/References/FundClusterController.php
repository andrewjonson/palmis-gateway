<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\FundClusterRepositoryInterface;
use App\Http\Resources\v1\References\FundClusterResource;
use Illuminate\Http\Request;

class FundClusterController extends Controller
{
    protected $rules = [];

    public function __construct(
        FundClusterRepositoryInterface $fundClusterRepository, 
        Request $request
    )
    {
        $this->modelRepository = $fundClusterRepository;
        $this->resource = FundClusterResource::class;
        $this->modelName = 'FundCluster';

        parent::__construct($request);
    }
}
