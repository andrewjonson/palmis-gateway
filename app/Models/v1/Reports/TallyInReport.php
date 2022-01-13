<?php

namespace App\Models\v1\Reports;

use App\Models\BaseModel;
use App\Models\v1\References\Signatory;
use App\Models\v1\Transactions\TallyIn;
use App\Models\v1\References\DocSetting;

class TallyInReport extends BaseModel
{
    protected $fillable = [
        'tally_in_id',
        'received_by_signatory_id',
        'noted_by_signatory_id',
        'doc_settings_id'
    ];

    protected $table = 'tr_tally_in_reports';

    public function tallyIn()
    {
        return $this->belongsTo(TallyIn::class, 'tally_in_id', 'id');
    }

    public function receivedBySignatory()
    {
        return $this->belongsTo(Signatory::class, 'received_by_signatory_id', 'id');
    }

    public function notedBySignatory()
    {
        return $this->belongsTo(Signatory::class, 'noted_by_signatory_id', 'id');
    }

    public function docSetting()
    {
        return $this->belongsTo(DocSetting::class, 'doc_settings_id', 'id');
    }
}