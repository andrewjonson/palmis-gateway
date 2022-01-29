<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use App\Models\v1\Transactions\Ris;
use App\Models\v1\Transactions\StdItem;
use App\Models\v1\Transactions\Inventory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\v1\References\IssuanceDirectivePurpose;

class Std extends BaseModel
{
    use ModularTrait;
    use SoftDeletes;

    protected $fillable = [
        'std_number', 
        'authority', 
        'issuance_directive_purpose_id',
        'date',
        'iar_id',
        'remarks'
    ];
    protected $table = 'tr_stds';

    public function stdItems()
    {
        return $this->hasMany(StdItem::class, 'std_id');
    }

    public function issuanceDirectivePurpose()
    {
        return $this->belongsTo(IssuanceDirectivePurpose::class, 'issuance_directive_purpose_id');
    }

    public function ris()
    {
        return $this->hasMany(Ris::class, 'std_id');
    }

    public function iar()
    {
        return $this->belongsTo(Iar::class, 'iar_id');
    }
}