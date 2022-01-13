<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\ServicingFpaoRepositoryInterface;
use App\Http\Resources\v1\References\ServicingFpaoResource;
use Illuminate\Http\Request;

class ServicingFpaoController extends Controller
{
    protected $rules = [];

    public function __construct(
        ServicingFpaoRepositoryInterface $servicingFpaoRepository, 
        Request $request
    )
    {
        $this->modelRepository = $servicingFpaoRepository;
        $this->resource = ServicingFpaoResource::class;
        $this->modelName = 'ServicingFpao';

        parent::__construct($request);
    }
}
