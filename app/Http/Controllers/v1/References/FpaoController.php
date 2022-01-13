<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\FpaoRepositoryInterface;
use App\Http\Resources\v1\References\FpaoResource;
use Illuminate\Http\Request;

class FpaoController extends Controller
{
    protected $rules = [];

    public function __construct(
        FpaoRepositoryInterface $fpaoRepository, 
        Request $request
    )
    {
        $this->modelRepository = $fpaoRepository;
        $this->resource = FpaoResource::class;
        $this->modelName = 'Fpao';

        parent::__construct($request);
    }
}
