<?php

namespace App\Http\Controllers\v1\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\References\ResponsibilityCodeResource;
use App\Repositories\Interfaces\v1\References\ResponsibilityCodeRepositoryInterface;

class ResponsibilityCodeController extends Controller
{
    protected $rules = [];

    public function __construct(
        ResponsibilityCodeRepositoryInterface $responsibilityCodeRepository, 
        Request $request
    )
    {
        $this->modelRepository = $responsibilityCodeRepository;
        $this->resource = ResponsibilityCodeResource::class;
        $this->modelName = 'ResponsibilityCode';

        parent::__construct($request);
    }
}
