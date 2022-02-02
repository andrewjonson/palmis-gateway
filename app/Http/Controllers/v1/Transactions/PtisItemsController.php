<?php

namespace App\Http\Controllers\v1\Transactions;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\v1\Transactions\PtisItemsRepositoryInterface;
use App\Http\Resources\v1\Transactions\PtisItemsResource;
use Illuminate\Http\Request;

class PtisItemsController extends Controller
{
    protected $rules = [];

    public function __construct(
        PtisItemsRepositoryInterface $ptisItemsRepository, 
        Request $request
    )
    {
        $this->modelRepository = $ptisItemsRepository;
        $this->resource = PtisItemsResource::class;
        $this->modelName = 'PtisItems';

        parent::__construct($request);
    }
}
