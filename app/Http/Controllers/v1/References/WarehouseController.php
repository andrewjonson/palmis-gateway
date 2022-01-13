<?php

namespace App\Http\Controllers\v1\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\References\WarehouseResource;
use App\Repositories\Interfaces\v1\References\WarehouseRepositoryInterface;

class WarehouseController extends Controller
{
    protected $rules = [];

    public function __construct(
        WarehouseRepositoryInterface $warehouseRepository, 
        Request $request
    )
    {
        $this->modelRepository = $warehouseRepository;
        $this->resource = WarehouseResource::class;
        $this->modelName = 'Warehouse';

        parent::__construct($request);
    }
}
