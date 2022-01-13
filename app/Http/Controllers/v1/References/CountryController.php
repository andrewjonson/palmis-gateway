<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\CountryRepositoryInterface;
use App\Http\Resources\v1\References\CountryResource;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $rules = [];

    public function __construct(
        CountryRepositoryInterface $countryRepository, 
        Request $request
    )
    {
        $this->modelRepository = $countryRepository;
        $this->resource = CountryResource::class;
        $this->modelName = 'Country';

        parent::__construct($request);
    }
}
