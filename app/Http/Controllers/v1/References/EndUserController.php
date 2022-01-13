<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\EndUserRepositoryInterface;
use App\Http\Resources\v1\References\EndUserResource;
use Illuminate\Http\Request;

class EndUserController extends Controller
{
    protected $rules = [];

    public function __construct(
        EndUserRepositoryInterface $endUserRepository, 
        Request $request
    )
    {
        $this->modelRepository = $endUserRepository;
        $this->resource = EndUserResource::class;
        $this->modelName = 'EndUser';

        parent::__construct($request);
    }
}
