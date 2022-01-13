<?php

namespace App\Repositories\Eloquent\v1\Transactions;

use App\Models\v1\Transactions\Inventory;
use App\Repositories\Eloquent\v1\BaseRepository;
use App\Repositories\Interfaces\v1\Transactions\InventoryRepositoryInterface;

class InventoryRepository extends BaseRepository implements InventoryRepositoryInterface
{
    public function __construct(Inventory $model)
    {
        $this->model = $model;
    }

    public function getTallyId($id)
    {
        return $this->model->where('tally_in_id', $id)->get();
    }

    public function getInventory($request)
    {
        $lotNr = $request->lot_number;
        return $this->model->where('lot_number', 'ilike', '%'. $lotNr . '%')->where('is_accepted', true)->get();
    }

    /**
     * Search Lot Nr
     * 
     * @param $lotNr
     * @return mixed
     */
    public function searchLotNr($lotNr)
    {
        return $this->model->select('lot_number', 'temp_balance_qty', 'tr_stock_cards.id as stock_card_id', 'tr_inventories.id as inventory_id', 'ammunition_nomenclature_id')
                        ->join('tr_stock_cards', 'tr_stock_cards.inventory_id', '=', 'tr_inventories.id')
                        ->where('lot_number', 'ilike', '%'.$lotNr.'%')
                        ->get();
    }
}