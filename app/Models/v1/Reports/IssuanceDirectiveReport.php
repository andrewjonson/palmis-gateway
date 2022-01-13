<?php

namespace App\Models\v1\Reports;

use App\Models\BaseModel;
use App\Models\v1\References\Signatory;
use App\Models\v1\References\DocSetting;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\v1\Transactions\IssuanceDirective;
use App\Models\v1\Transactions\IssuanceDirectiveItem;
// use App\Traits\ModularTrait;

class IssuanceDirectiveReport extends BaseModel
{
    // use ModularTrait;
    use SoftDeletes;

    protected $table = 'tr_issuance_directive_reports';
    protected $fillable = [
        'issuance_directive_id', 
        'prepared_by_id', 
        'approved_by_id', 
        'doc_setting_id'
    ];

    public function issuanceDirective()
    {
        return $this->belongsTo(IssuanceDirective::class, 'issuance_directive_id', 'id');
    }

    public function issuanceDirectiveItems()
    {
        return $this->hasMany(IssuanceDirectiveItem::class, 'issuance_directive_id', 'issuance_directive_id');
    }

    public function docSetting()
    {
        return $this->belongsTo(DocSetting::class, 'doc_setting_id', 'id');
    }

    public function preparedBySignatory()
    {
        return $this->belongsTo(Signatory::class, 'prepared_by_id', 'id');
    }

    public function approvedBySignatory()
    {
        return $this->belongsTo(Signatory::class, 'approved_by_id', 'id');
    }
}