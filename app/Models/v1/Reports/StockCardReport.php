<?php

namespace App\Models\v1\Reports;

use App\Models\BaseModel;
use App\Models\v1\References\Signatory;
use App\Models\v1\References\DocSetting;
use App\Models\v1\Transactions\StockCard;
use Illuminate\Database\Eloquent\SoftDeletes;
// use App\Traits\ModularTrait;

class StockCardReport extends BaseModel
{
    // use ModularTrait;
    use SoftDeletes;

    protected $table = 'tr_stock_card_reports';
    protected $fillable = [
        'stock_card_id',
        'received_from_id',
        'received_by_id',
        'doc_setting_id'
    ];

    public function stockCard()
    {
        return $this->belongsTo(StockCard::class, 'stock_card_id', 'id');
    }

    public function docSetting()
    {
        return $this->belongsTo(DocSetting::class, 'doc_settings_id', 'id');
    }

    public function receivedFromSignatory()
    {
        return $this->belongsTo(Signatory::class, 'received_from_id', 'id');
    }

    public function receivedBySignatory()
    {
        return $this->belongsTo(Signatory::class, 'received_by_id', 'id');
    }
}