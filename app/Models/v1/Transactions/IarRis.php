<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Models\v1\Transactions\Ris;
use App\Models\v1\Transactions\StockCard;

class IarRis extends BaseModel
{

    protected $table = 'tr_stock_card_references';
    protected $fillable = [
        'reference',
        'stock_card_id'
    ];

    public function stockCard()
    {
        return $this->belongsTo(StockCard::class, 'stock_card_id', 'id');
    }

    public function ris()
    {
        return $this->belongsTo(Ris::class, 'ris_id', 'id');
    }
}