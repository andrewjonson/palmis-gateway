<?php

namespace App\Http\Controllers\v1\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\References\FpaoUnitResource;
use App\Http\Resources\v1\References\FpaoUnit\FilterUnitResource;
use App\Repositories\Interfaces\v1\References\FpaoUnitRepositoryInterface;

class FpaoUnitController extends Controller
{
    protected $rules = [];

    public function __construct(
        FpaoUnitRepositoryInterface $fpaoUnitRepository, 
        Request $request
    )
    {
        $this->modelRepository = $fpaoUnitRepository;
        $this->filterUnitResource = FilterUnitResource::class;
        $this->resource = FpaoUnitResource::class;
        $this->modelName = 'FpaoUnit';

        parent::__construct($request);
    }

    /**
     * Store Fpao Unit
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->merge([
            'fpao_id' => hashid_decode($request->fpao_id),
            'pamu_id' => hashid_decode($request->pamu_id),
            // 'unit_id' => hashid_decode($request->unit_id)
        ]);
        try {
            $this->modelRepository->create($request->all());
            return $this->successResponse($this->modelName.' Created Successfully', DATA_CREATED);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Update Fpao Unit
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $id = hashid_decode($id);
        $data = $this->modelRepository->find($id);

        if (!$data) {
            throw new AuthorizationException;
        }
        
        $request->merge([
            'fpao_id' => hashid_decode($request->fpao_id),
            'pamu_id' => hashid_decode($request->pamu_id),
            // 'unit_id' => hashid_decode($request->unit_id)
        ]);
        try {
            $data->update($request->all());
            return $this->successResponse($this->modelName.' Updated Successfully', DATA_CREATED);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Filter Fpao Unit based on Fpao Id
     * 
     * @param $id
     */
    public function filterUnit($id)
    {
        $id = hashid_decode($id);
        try {
            $result = $this->modelRepository->filterUnit($id);
            return $this->filterUnitResource::collection($result);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
