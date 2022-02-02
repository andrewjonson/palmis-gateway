<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Traits\ModularTrait;

class DdaNrDefectives extends BaseModel
{
    use ModularTrait;

    protected $fillable = [
        'dda_packed_id',
        'crit',
        'maj',
        'min'
    ];

    protected $table = 'tr_dda_nr_defectives';
}