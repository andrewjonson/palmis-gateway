<?php

namespace App\Http\Controllers\v1\Transactions;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\Transactions\RsmiRepositoryInterface;
use App\Http\Resources\v1\Transactions\RsmiResource;
use Illuminate\Http\Request;

class RsmiController extends Controller
{
    protected $rules = [];

    public function __construct(
        RsmiRepositoryInterface $rsmiRepository, 
        Request $request
    )
    {
        $this->modelRepository = $rsmiRepository;
        $this->resource = RsmiResource::class;
        $this->modelName = 'Rsmi';

        parent::__construct($request);
    }
}
