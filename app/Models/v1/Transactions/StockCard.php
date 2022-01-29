<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Models\v1\References\Signatory;
use App\Models\v1\Transactions\Inventory;
use App\Models\v1\Transactions\StockCardReference;
use App\Models\v1\Transactions\IssuanceDirectiveItem;

class StockCard extends BaseModel
{
    protected $fillable = ['inventory_id', 'stock_card_nr', 'remarks'];
    protected $table = 'tr_stock_cards';

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'id');
    }

    public function issuanceDirectiveItem()
    {
        return $this->belongsTo(IssuanceDirectiveItem::class, 'id', 'stock_card_id');
    }

    public function stockCardReference()
    {
        return $this->hasMany(StockCardReference::class, 'stock_card_id', 'id');
    }

    // public function receivedFromSignatory()
    // {
    //     return $this->belongsTo(Signatory::class, 'received_from_id', 'id');
    // }

    // public function receivedBySignatory()
    // {
    //     return $this->belongsTo(Signatory::class, 'received_by_id', 'id');
    // }
}