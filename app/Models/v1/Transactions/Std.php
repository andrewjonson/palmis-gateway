<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use App\Models\v1\Transactions\StdItem;
use App\Models\v1\Transactions\Inventory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Std extends BaseModel
{
    use ModularTrait;
    use SoftDeletes;

    protected $fillable = [
        'std_number', 
        'authority', 
        'purpose',
        'date'
    ];
    protected $table = 'tr_stds';

    public function stdItems()
    {
        return $this->hasMany(StdItem::class, 'std_id');
    }
}