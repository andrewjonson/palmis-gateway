<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use App\Models\v1\Transactions\DdaPacked;

class Dda extends BaseModel
{
    use ModularTrait;

    protected $fillable = [
        'depot',
        'date',
        'lot_nr',
        'packed',
        'fsn',
        'past_storage',
        'current_storage',
        'lot_received_from',
        'date_last_inspected',
        'date_inspected',
        'sample_size',
        'quantity_storage',
        'box',
        'straping',
        'marking',
        'carton',
        'others'
    ];

    protected $table = 'tr_ddas';

    public function ddaPacks()
    {
        return $this->hasMany(DdaPacked::class, 'dda_id');
    }
}