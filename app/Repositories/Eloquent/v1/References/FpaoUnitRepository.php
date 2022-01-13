<?php

namespace App\Repositories\Eloquent\v1\References;

use App\Models\v1\References\FpaoUnit;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\References\FpaoUnitRepositoryInterface;

class FpaoUnitRepository extends BaseRepository implements FpaoUnitRepositoryInterface
{
    public function __construct(FpaoUnit $model)
    {
        $this->model = $model;
    }


    public function filterUnit($id)
    {
        return $this->model->whereHas('fpao', function($query) use($id) {
            return $query->where('fpao_id', $id);
        })->paginate();
    }
}