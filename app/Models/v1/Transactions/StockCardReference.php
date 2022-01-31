<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockCardReference extends BaseModel
{
    use ModularTrait;
    use SoftDeletes;

    protected $table = 'tr_stock_card_references';
    protected $fillable = [
        'reference',
        'stock_card_id',
        'office',
        'iar_id',
        'ris_id',
        'date',
        'balance',
        'quantity'
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