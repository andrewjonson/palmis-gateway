<?php

namespace App\Http\Controllers\v1\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\References\SignatoryResource;
use App\Http\Resources\v1\References\SignatoryCoResource;
use App\Http\Resources\v1\References\ToggleSignatoryResource;
use App\Repositories\Interfaces\v1\References\SignatoryRepositoryInterface;
use App\Repositories\Interfaces\v1\References\SignatoryCoRepositoryInterface;

class SignatoryController extends Controller
{
    protected $rules = [];

    public function __construct(
        SignatoryRepositoryInterface $signatoryRepository, 
        SignatoryCoRepositoryInterface $signatorycoRepository,
        Request $request
    )
    {
        $this->modelRepository = $signatoryRepository;
        $this->signatorycoRepository = $signatorycoRepository;
        $this->resource = SignatoryResource::class;
        $this->toggleResource = ToggleSignatoryResource::class;
        $this->resourceList = SignatoryCoResource::class;
        $this->modelName = 'Signatory';

        parent::__construct($request);
    }

    public function toggleSignatory()
    {
        try {
            $result = $this->modelRepository->all();
            return $this->toggleResource::collection($result);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $results = $this->signatorycoRepository->search($keyword, $rowsPerPage);
            return $this->resourceList::collection($results);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        try {
            $signatory = $this->modelRepository->create([
                'pmcode' => $request->pmcode,
                'name' => $request->name,
                'rank' => $request->rank,
                'afposmos' => $request->afposmos,
                'unit' => $request->unit,
                'position_office' => $request->position_office,
                'designation' => $request->designation
            ]);

            $parent = $this->signatorycoRepository->create([
                'signatory_id' => $signatory->id,
                'co_id' => $request->co_id
            ]);

            return $this->successResponse($this->modelName.' Created Successfully', DATA_CREATED);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
