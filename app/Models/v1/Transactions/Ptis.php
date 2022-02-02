<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ptis extends BaseModel
{
    use ModularTrait;
    use SoftDeletes;

    protected $table = 'tr_ptis';
    protected $fillable = [
        'to',
        'from',
        'turn_in_slip_nr',
        'voucher_nr',
        'basis',
        'remarks'
    ];
}