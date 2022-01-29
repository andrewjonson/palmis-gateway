<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\UacsObjectCodeRepositoryInterface;
use App\Http\Resources\v1\References\UacsObjectCodeResource;
use Illuminate\Http\Request;

class UacsObjectCodeController extends Controller
{
    protected $rules = [];

    public function __construct(
        UacsObjectCodeRepositoryInterface $uacsObjectCodeRepository, 
        Request $request
    )
    {
        $this->modelRepository = $uacsObjectCodeRepository;
        $this->resource = UacsObjectCodeResource::class;
        $this->modelName = 'UacsObjectCode';

        parent::__construct($request);
    }
}
