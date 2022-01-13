<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\IssuanceDirectiveConditionRepositoryInterface;
use App\Http\Resources\v1\References\IssuanceDirectiveConditionResource;
use Illuminate\Http\Request;

class IssuanceDirectiveConditionController extends Controller
{
    protected $rules = [];

    public function __construct(
        IssuanceDirectiveConditionRepositoryInterface $issuanceDirectiveConditionRepository, 
        Request $request
    )
    {
        $this->modelRepository = $issuanceDirectiveConditionRepository;
        $this->resource = IssuanceDirectiveConditionResource::class;
        $this->modelName = 'IssuanceDirectiveCondition';

        parent::__construct($request);
    }
}
