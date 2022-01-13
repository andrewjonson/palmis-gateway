<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\ConditionRepositoryInterface;
use App\Http\Resources\v1\References\ConditionResource;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    protected $rules = [];

    public function __construct(
        ConditionRepositoryInterface $conditionRepository, 
        Request $request
    )
    {
        $this->modelRepository = $conditionRepository;
        $this->resource = ConditionResource::class;
        $this->modelName = 'Condition';

        parent::__construct($request);
    }
}
