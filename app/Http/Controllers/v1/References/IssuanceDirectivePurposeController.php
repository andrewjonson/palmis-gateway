<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\IssuanceDirectivePurposeRepositoryInterface;
use App\Http\Resources\v1\References\IssuanceDirectivePurposeResource;
use Illuminate\Http\Request;

class IssuanceDirectivePurposeController extends Controller
{
    protected $rules = [];

    public function __construct(
        IssuanceDirectivePurposeRepositoryInterface $issuanceDirectivePurposeRepository, 
        Request $request
    )
    {
        $this->modelRepository = $issuanceDirectivePurposeRepository;
        $this->resource = IssuanceDirectivePurposeResource::class;
        $this->modelName = 'IssuanceDirectivePurpose';

        parent::__construct($request);
    }
}
