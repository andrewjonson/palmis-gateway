<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\RegionRepositoryInterface;
use App\Http\Resources\v1\References\RegionResource;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    protected $rules = [];

    public function __construct(
        RegionRepositoryInterface $regionRepository, 
        Request $request
    )
    {
        $this->modelRepository = $regionRepository;
        $this->resource = RegionResource::class;
        $this->modelName = 'Region';

        parent::__construct($request);
    }
}
