<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\ProvinceRepositoryInterface;
use App\Http\Resources\v1\References\ProvinceResource;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    protected $rules = [];

    public function __construct(
        ProvinceRepositoryInterface $provinceRepository, 
        Request $request
    )
    {
        $this->modelRepository = $provinceRepository;
        $this->resource = ProvinceResource::class;
        $this->modelName = 'Province';

        parent::__construct($request);
    }
}
