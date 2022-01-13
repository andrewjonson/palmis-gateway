<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\MunicityRepositoryInterface;
use App\Http\Resources\v1\References\MunicityResource;
use Illuminate\Http\Request;

class MunicityController extends Controller
{
    protected $rules = [];

    public function __construct(
        MunicityRepositoryInterface $municityRepository, 
        Request $request
    )
    {
        $this->modelRepository = $municityRepository;
        $this->resource = MunicityResource::class;
        $this->modelName = 'Municity';

        parent::__construct($request);
    }
}
