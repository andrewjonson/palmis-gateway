<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\ManufacturerRepositoryInterface;
use App\Http\Resources\v1\References\ManufacturerResource;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    protected $rules = [];

    public function __construct(
        ManufacturerRepositoryInterface $manufacturerRepository, 
        Request $request
    )
    {
        $this->modelRepository = $manufacturerRepository;
        $this->resource = ManufacturerResource::class;
        $this->modelName = 'Manufacturer';

        parent::__construct($request);
    }
}
