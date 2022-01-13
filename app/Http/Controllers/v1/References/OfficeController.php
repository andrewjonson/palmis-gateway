<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\OfficeRepositoryInterface;
use App\Http\Resources\v1\References\OfficeResource;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    protected $rules = [];

    public function __construct(
        OfficeRepositoryInterface $officeRepository, 
        Request $request
    )
    {
        $this->modelRepository = $officeRepository;
        $this->resource = OfficeResource::class;
        $this->modelName = 'Office';

        parent::__construct($request);
    }
}
