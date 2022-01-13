<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\SignatoryCoRepositoryInterface;
use App\Http\Resources\v1\References\SignatoryCoResource;
use Illuminate\Http\Request;

class SignatoryCoController extends Controller
{
    protected $rules = [];

    public function __construct(
        SignatoryCoRepositoryInterface $signatoryCoRepository, 
        Request $request
    )
    {
        $this->modelRepository = $signatoryCoRepository;
        $this->resource = SignatoryCoResource::class;
        $this->modelName = 'SignatoryCo';

        parent::__construct($request);
    }
}
