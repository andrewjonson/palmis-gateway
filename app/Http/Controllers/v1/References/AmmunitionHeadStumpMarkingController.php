<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\AmmunitionHeadStumpMarkingRepositoryInterface;
use App\Http\Resources\v1\References\AmmunitionHeadStumpMarkingResource;
use Illuminate\Http\Request;

class AmmunitionHeadStumpMarkingController extends Controller
{
    protected $rules = [];

    public function __construct(
        AmmunitionHeadStumpMarkingRepositoryInterface $ammunitionHeadStumpMarkingRepository, 
        Request $request
    )
    {
        $this->modelRepository = $ammunitionHeadStumpMarkingRepository;
        $this->resource = AmmunitionHeadStumpMarkingResource::class;
        $this->modelName = 'AmmunitionHeadStumpMarking';

        parent::__construct($request);
    }
}
