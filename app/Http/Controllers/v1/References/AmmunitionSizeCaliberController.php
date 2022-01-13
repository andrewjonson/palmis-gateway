<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\AmmunitionSizeCaliberRepositoryInterface;
use App\Http\Resources\v1\References\AmmunitionSizeCaliberResource;
use Illuminate\Http\Request;

class AmmunitionSizeCaliberController extends Controller
{
    protected $rules = [];

    public function __construct(
        AmmunitionSizeCaliberRepositoryInterface $ammunitionSizeCaliberRepository, 
        Request $request
    )
    {
        $this->modelRepository = $ammunitionSizeCaliberRepository;
        $this->resource = AmmunitionSizeCaliberResource::class;
        $this->modelName = 'AmmunitionSizeCaliber';

        parent::__construct($request);
    }
}
