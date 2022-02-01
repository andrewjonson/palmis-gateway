<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use App\Models\v1\Transactions\DdaNrDefects;
use App\Models\v1\Transactions\DdaNrDefectives;

class DdaPacked extends BaseModel
{
    use ModularTrait;

    protected $fillable = [
        'condition_ammunition_item',
        'packed_type',
        'dda_id'
    ];

    protected $table = 'tr_dda_packeds';

    public function ddaNrDefect()
    {
        return $this->hasOne(DdaNrDefects::class, 'dda_packed_id');
    }

    public function ddaNrDefective()
    {
        return $this->hasOne(DdaNrDefectives::class, 'dda_packed_id');
    }
}