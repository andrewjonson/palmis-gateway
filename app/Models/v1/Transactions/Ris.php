<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Models\v1\Transactions\IssuanceDirective;

class Ris extends BaseModel
{
    protected $table = 'tr_ris';
    protected $fillable = [
        'issuance_directive_id', 
        'ris_nr',
        'status'
    ];

    public function issuanceDirective()
    {
        return $this->belongsTo(IssuanceDirective::class, 'issuance_directive_id', 'id');
    }
}