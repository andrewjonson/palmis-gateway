<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Auth\Access\AuthorizationException;

trait RestfulControllerTrait
{
    use ResponseTrait;

    public function __construct(Request $request)
    {
        $this->modelRepository;
        $this->resource;
    }

    public function validateRequest(Request $request)
    {
        $this->validate($request, $this->rules);
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $results = $this->modelRepository->search($keyword, $rowsPerPage);
            return $this->resource::collection($results);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        try {
            $this->modelRepository->create($request->all());
            return $this->successResponse($this->modelName.' Created Successfully', DATA_CREATED);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request);
        $id = hashid_decode($id);
        $data = $this->modelRepository->find($id);
        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->update($request->all());
            return $this->successResponse($this->modelName.' Updated Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        $id = hashid_decode($id);
        $data = $this->modelRepository->find($id);
        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->delete();
            return $this->successResponse($this->modelName.' Deleted Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function restore($id)
    {
        $id = hashid_decode($id);
        $data = $this->modelRepository->onlyTrashedById($id);
        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->restore();
            return $this->successResponse($this->modelName.' Restored Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function onlyTrashed(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $results = $this->modelRepository->onlyTrashed($keyword, $rowsPerPage);
            return $this->resource::collection($results);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function forceDelete($id)
    {
        $id = hashid_decode($id);
        $data = $this->modelRepository->onlyTrashedById($id);
        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->forceDelete();
            return $this->successResponse($this->modelName.' Permanently Deleted Successfully', DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}