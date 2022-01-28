<?php

namespace App\Http\Controllers\v1\Transactions;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Resources\v1\Transactions\StockCardResource;
use App\Repositories\Interfaces\v1\Transactions\StockCardRepositoryInterface;

class StockCardController extends Controller
{
    use ResponseTrait;

    public function __construct(StockCardRepositoryInterface $stockCardRepository)
    {
        $this->modelRepository = $stockCardRepository;
        $this->resource = StockCardResource::class;
        $this->modelName = 'Stock Card';
    }

    /**
     * Get List of Stock Cards
     * 
     * @param Illuminate\Http\Request
     * @return mixed
     */
    public function getList(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $result = $this->modelRepository->search($keyword, $rowsPerPage);
            return $this->resource::collection($result);
        }catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    /**
     * Get List of Stock Card by id
     * 
     * @param @id
     * @return mixed
     */
    public function getStockCardById($id)
    {
        $id = hashid_decode($id);

        $data = $this->modelRepository->find($id);
        if(!$data) {
            throw new AuthorizationException;
        }
        return new $this->resource($data);
    }
}
