<?php

namespace App\Models\v1\References;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWarehouse extends BaseModel
{
    // use ModularTrait;
    use SoftDeletes;

    protected $fillable = ['pmcode', 'warehouse_id'];
    protected $table = 'rf_user_warehouses';

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }
}