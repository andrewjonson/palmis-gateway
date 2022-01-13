<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Models\v1\Transactions\StockCard;
use App\Models\v1\Transactions\IssuanceDirective;

class IssuanceDirectiveItem extends BaseModel
{
    protected $fillable = ['issuance_directive_id', 'stock_card_id', 'quantity', 'remarks'];
    protected $table = 'tr_issuance_directive_items';

    public function stockCard()
    {
        return $this->belongsTo(StockCard::class, 'stock_card_id', 'id');
    }

    public function issuanceDirective()
    {
        return $this->belongsTo(IssuanceDirective::class, 'issuance_directive_id', 'id');
    }
}