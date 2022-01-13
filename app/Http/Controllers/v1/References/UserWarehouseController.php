<?php

namespace App\Http\Controllers\v1\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\References\UserWarehouseResource;
use App\Repositories\Interfaces\v1\References\UserWarehouseRepositoryInterface;

class UserWarehouseController extends Controller
{
    protected $rules = [];

    public function __construct(
        UserWarehouseRepositoryInterface $userWarehouseRepository, 
        Request $request
    )
    {
        $this->modelRepository = $userWarehouseRepository;
        $this->resource = UserWarehouseResource::class;
        $this->modelName = 'UserWarehouse';

        parent::__construct($request);
    }

    public function store(Request $request)
    {
        $request->merge([
            'warehouse_id' => hashid_decode($request->warehouse_id)
        ]);

        try {
            $this->modelRepository->create($request->all());
            return $this->successResponse($this->modelName.' Updated Successfully', DATA_OK);

        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $id = hashid_decode($id);
        $data = $this->modelRepository->find($id);

        if (!$data) {
            throw new AuthorizationException;
        }
        
        $request->merge([
            'warehouse_id' => hashid_decode($request->warehouse_id)
        ]);

        try {
            $this->modelRepository->create($request->all());
            return $this->successResponse($this->modelName.' Updated Successfully', DATA_OK);

        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
