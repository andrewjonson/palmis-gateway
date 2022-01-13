<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\AmmunitionDetailRepositoryInterface;
use App\Http\Resources\v1\References\AmmunitionDetailResource;
use Illuminate\Http\Request;

class AmmunitionDetailController extends Controller
{
    protected $rules = [];

    public function __construct(
        AmmunitionDetailRepositoryInterface $ammunitionDetailRepository, 
        Request $request
    )
    {
        $this->modelRepository = $ammunitionDetailRepository;
        $this->resource = AmmunitionDetailResource::class;
        $this->modelName = 'AmmunitionDetail';

        parent::__construct($request);
    }
}
