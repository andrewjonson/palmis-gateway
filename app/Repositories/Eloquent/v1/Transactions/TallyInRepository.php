<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Models\v1\Transactions\TallyIn;
use App\Models\v1\Transactions\Inventory;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\Transactions\TallyInRepositoryInterface;

class TallyInRepository extends BaseRepository implements TallyInRepositoryInterface
{
    public function __construct(TallyIn $model, Inventory $inventory)
    {
        $this->model = $model;
        $this->inventory = $inventory;
    }

    /**
     * Get Tally
     * 
     * @param $request
     * @return mixed
     */
    public function getTally($request)
    {
        return $this->model->paginate();
    }

    /**
     * Print Tally
     * 
     * @param $id
     * @return mixed
     */
    public function printTally($id)
    {
        return $this->inventory->where('tally_in_id', $id)->paginate();
    }

    /**
     * Filter Tally based on Type and Category
     * 
     * @param $type
     * @param $category_id
     * @return mixed
     */
    public function filterTally($stock_disposition, $category_id)
    {
        return $this->model->whereHas('inventory', function($query) use($stock_disposition, $category_id) {
            return $query->where('stock_disposition', $stock_disposition);
            // ->where('category_id', $category_id);
        })->paginate();
    }
}