<?php

namespace App\Http\Controllers\v1\Dashboard;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\Dashboard\DashboardResource;
use App\Repositories\Interfaces\v1\Dashboard\DashboardRepositoryInterface;
use App\Repositories\Interfaces\v1\Transactions\IssuanceDirectiveRepositoryInterface;

class DashboardController extends Controller
{
    protected $rules = [];

    public function __construct(
        IssuanceDirectiveRepositoryInterface $issuancedirectiveRepository, 
        DashboardRepositoryInterface $modelRepository,
        Request $request
    )
    {
        $this->modelRepository = $modelRepository;
        $this->issuancedirectiveRepository = $issuancedirectiveRepository;
        $this->resource = DashboardResource::class;
        $this->modelName = 'Dashboard';

        parent::__construct($request);
    }

    public function getListNomenclaturePerPamu($id)
    {
        $pamuId = hashid_decode($id);
        $data = $this->issuancedirectiveRepository
                            ->getModel()
                            ->where('pamu_id', $pamuId)
                            ->get();

        if(!$data) {
            throw new AuthorizationException;
        }
        try {
            return $this->resource::collection($data);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
