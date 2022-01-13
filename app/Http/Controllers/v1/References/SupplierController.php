<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\SupplierRepositoryInterface;
use App\Http\Resources\v1\References\SupplierResource;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $rules = [];

    public function __construct(
        SupplierRepositoryInterface $supplierRepository, 
        Request $request
    )
    {
        $this->modelRepository = $supplierRepository;
        $this->resource = SupplierResource::class;
        $this->modelName = 'Supplier';

        parent::__construct($request);
    }
}
