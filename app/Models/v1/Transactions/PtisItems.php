<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
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
}