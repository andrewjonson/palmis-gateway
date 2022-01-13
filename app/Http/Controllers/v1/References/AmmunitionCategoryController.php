<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\AmmunitionCategoryRepositoryInterface;
use App\Http\Resources\v1\References\AmmunitionCategoryResource;
use Illuminate\Http\Request;

class AmmunitionCategoryController extends Controller
{
    protected $rules = [];

    public function __construct(
        AmmunitionCategoryRepositoryInterface $ammunitionCategoryRepository, 
        Request $request
    )
    {
        $this->modelRepository = $ammunitionCategoryRepository;
        $this->resource = AmmunitionCategoryResource::class;
        $this->modelName = 'AmmunitionCategory';

        parent::__construct($request);
    }

    /**
     * filter category
     */
    public function search(Request $request)
    {
        $keyword = $request->name;
        try {
            $result = $this->modelRepository->paginate();
            return $this->resource::collection($result);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
