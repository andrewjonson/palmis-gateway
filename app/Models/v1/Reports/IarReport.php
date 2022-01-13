<?php

namespace App\Models\v1\Reports;

use App\Models\BaseModel;
use App\Models\v1\References\Signatory;
use App\Models\v1\References\DocSetting;
use App\Models\v1\Transactions\Iar;

class IarReport extends BaseModel
{
    protected $fillable = [
        'iar_id',
        'doc_settings_id',
        'acceptance_signatory_id',
        'inspection_signatory_id'
    ];

    protected $table = 'tr_iar_reports';

    public function iar()
    {
        return $this->belongsTo(Iar::class, 'iar_id', 'id');
    }

    public function docSetting()
    {
        return $this->belongsTo(DocSetting::class, 'doc_settings_id', 'id');
    }

    public function acceptanceSignatory()
    {
        return $this->belongsTo(Signatory::class, 'acceptance_signatory_id', 'id');
    }

    public function inspectionSignatory()
    {
        return $this->belongsTo(Signatory::class, 'inspection_signatory_id', 'id');
    }
}