<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Models\v1\Transactions\Std;
use App\Models\v1\References\Office;
use App\Models\v1\Transactions\TallyIn;
use App\Models\v1\References\FundCluster;
use App\Models\v1\Transactions\Inventory;
use App\Models\v1\References\ResponsibilityCode;
use App\Models\v1\Transactions\IssuanceDirective;

class Iar extends BaseModel
{
    protected $fillable = [
        'tally_in_id',
        'iar_nr',
        'entity_name',
        'date',
        'po_nr',
        'fund_cluster_id',
        'invoice_nr',
        'invoice_date',
        'requisitioning_office_id',
        'responsibility_center_code_id',
        'accountable_officer',
        'officer_designation'
    ];
    protected $table = 'tr_iars';

    public function tallyIn()
    {
        return $this->belongsTo(TallyIn::class, 'tally_in_id', 'id');
    }

    public function fundCluster()
    {
        return $this->belongsTo(FundCluster::class, 'fund_cluster_id', 'id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'requisitioning_office_id', 'id');
    }

    public function responsibilityCode()
    {
        return $this->belongsTo(ResponsibilityCode::class, 'responsibility_center_code_id', 'id');
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'tally_in_id', 'tally_in_id');
    }

    public function issuanceDirective()
    {
        return $this->hasOne(IssuanceDirective::class, 'iar_id');
    }

    public function std()
    {
        return $this->hasOne(Std::class, 'iar_id');
    }
}