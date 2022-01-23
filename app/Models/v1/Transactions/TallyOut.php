<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\v1\Transactions\IssuanceDirectiveItem;

class TallyOut extends BaseModel
{
    use ModularTrait;
    use SoftDeletes;

    protected $fillable = ['ris_id', 'unservisable', 'issuance_directive_item_id'];
    protected $table = 'tr_tally_out';

    public function ris()
    {
        return $this->belongsTo(Ris::class, 'ris_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(IssuanceDirectiveItem::class, 'issuance_directive_item_id', 'id');
    }
}