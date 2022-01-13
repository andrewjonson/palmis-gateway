<?php

namespace App\Http\Controllers\v1\References;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\References\FssuRepositoryInterface;
use App\Http\Resources\v1\References\FssuResource;
use Illuminate\Http\Request;

class FssuController extends Controller
{
    protected $rules = [];

    public function __construct(
        FssuRepositoryInterface $fssuRepository, 
        Request $request
    )
    {
        $this->modelRepository = $fssuRepository;
        $this->resource = FssuResource::class;
        $this->modelName = 'Fssu';

        parent::__construct($request);
    }
}
