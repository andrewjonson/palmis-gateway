<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use App\Models\v1\References\Fpao;
use App\Models\v1\References\Fssu;
use App\Models\v1\Transactions\Inventory;

class StdItem extends BaseModel
{
    use ModularTrait;

    protected $fillable = [
        'inventory_id',
        'cognizant_fpao_id',
        'receiving_fpao_id',
        'cognizant_fssu_id',
        'receiving_fssu_id',
        'std_id'
    ];
    protected $table = 'tr_std_items';

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function cognizantFpao()
    {
        return $this->belongsTo(Fpao::class, 'cognizant_fpao_id');
    }

    public function receivingFpao()
    {
        return $this->belongsTo(Fpao::class, 'receiving_fpao_id');
    }

    public function cognizantFssu()
    {
        return $this->belongsTo(Fssu::class, 'cognizant_fssu_id');
    }

    public function receivingFssu()
    {
        return $this->belongsTo(Fssu::class, 'receiving_fssu_id');
    }
}