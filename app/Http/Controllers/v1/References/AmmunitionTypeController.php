<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\AmmunitionTypeRepositoryInterface;
use App\Http\Resources\v1\References\AmmunitionTypeResource;
use Illuminate\Http\Request;

class AmmunitionTypeController extends Controller
{
    protected $rules = [];

    public function __construct(
        AmmunitionTypeRepositoryInterface $ammunitionTypeRepository, 
        Request $request
    )
    {
        $this->modelRepository = $ammunitionTypeRepository;
        $this->resource = AmmunitionTypeResource::class;
        $this->modelName = 'AmmunitionType';

        parent::__construct($request);
    }
}
