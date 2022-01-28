<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Models\v1\References\FundCluster;
use App\Models\v1\References\ResponsibilityCode;
use App\Models\v1\Transactions\IssuanceDirective;

class Ris extends BaseModel
{
    protected $table = 'tr_ris';
    protected $fillable = [
        'issuance_directive_id',
        'std_id',
        'ris_nr',
        'status',
    ];

    public function issuanceDirective()
    {
        return $this->belongsTo(IssuanceDirective::class, 'issuance_directive_id', 'id');
    }

    public function responsibilityCode()
    {
        return $this->belongsTo(ResponsibilityCode::class, 'responsibility_center_code_id');
    }

    public function fundCluster()
    {
        return $this->belongsTo(FundCluster::class, 'fund_cluster_id');
    }
}