<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\AmmunitionClassificationRepositoryInterface;
use App\Http\Resources\v1\References\AmmunitionClassificationResource;
use Illuminate\Http\Request;

class AmmunitionClassificationController extends Controller
{
    protected $rules = [];

    public function __construct(
        AmmunitionClassificationRepositoryInterface $ammunitionClassificationRepository, 
        Request $request
    )
    {
        $this->modelRepository = $ammunitionClassificationRepository;
        $this->resource = AmmunitionClassificationResource::class;
        $this->modelName = 'AmmunitionClassification';

        parent::__construct($request);
    }
}
