<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\MakeRepositoryInterface;
use App\Http\Resources\v1\References\MakeResource;
use Illuminate\Http\Request;

class MakeController extends Controller
{
    protected $rules = [];

    public function __construct(
        MakeRepositoryInterface $makeRepository, 
        Request $request
    )
    {
        $this->modelRepository = $makeRepository;
        $this->resource = MakeResource::class;
        $this->modelName = 'Make';

        parent::__construct($request);
    }
}
