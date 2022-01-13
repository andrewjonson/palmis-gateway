<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\AmmunitionSupplyRepositoryInterface;
use App\Http\Resources\v1\References\AmmunitionSupplyResource;
use Illuminate\Http\Request;

class AmmunitionSupplyController extends Controller
{
    protected $rules = [];

    public function __construct(
        AmmunitionSupplyRepositoryInterface $ammunitionSupplyRepository, 
        Request $request
    )
    {
        $this->modelRepository = $ammunitionSupplyRepository;
        $this->resource = AmmunitionSupplyResource::class;
        $this->modelName = 'AmmunitionSupply';

        parent::__construct($request);
    }
}
