<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use App\Models\v1\Transactions\Inventory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PtisItems extends BaseModel
{
    use ModularTrait;
    use SoftDeletes;

    protected $table = 'tr_ptis_items';
    protected $fillable = [
        'ptis_id',
        'lot_nr',
        'quantity',
        'remarks'
    ];

    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'lot_number', 'lot_nr');
    }
}