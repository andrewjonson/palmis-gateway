<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\AmmunitionUomRepositoryInterface;
use App\Http\Resources\v1\References\AmmunitionUomResource;
use Illuminate\Http\Request;

class AmmunitionUomController extends Controller
{
    protected $rules = [];

    public function __construct(
        AmmunitionUomRepositoryInterface $ammunitionUomRepository, 
        Request $request
    )
    {
        $this->modelRepository = $ammunitionUomRepository;
        $this->resource = AmmunitionUomResource::class;
        $this->modelName = 'AmmunitionUom';

        parent::__construct($request);
    }
}
