<?php

namespace App\Models\v1\Transactions;

use App\Models\v1\Transactions\Iar;
use App\Models\v1\References\Country;
use App\Models\v1\References\Condition;
use App\Models\v1\References\Warehouse;
use App\Models\v1\Transactions\TallyIn;
use Illuminate\Database\Eloquent\Model;
use App\Models\v1\Transactions\StockCard;
use App\Models\v1\References\Manufacturer;
use App\Models\v1\References\AmmunitionNomenclature;

class Inventory extends Model
{
    protected $fillable = [
        'ammunition_nomenclature_id',
        'tally_in_id',
        'lot_number',
        'quantity',
        'date_manufactured',
        'date_accepted',
        'manufacturer_id',
        'made_id',
        'unit_price',
        'total_amount',
        'condition_id',
        'warehouse_id',
        'is_accepted',
        'temp_balance_qty',
        'receipt_qty'
       
    ];
    protected $table = 'tr_inventories';

    public function tallyIn()
    {
        return $this->belongsTo(TallyIn::class, 'tally_in_id', 'id');
    }

    public function iar()
    {
        return $this->belongsTo(Iar::class, 'tally_in_id', 'tally_in_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'made_id', 'id');
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class, 'condition_id', 'id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }

    public function ammunitionNomenclature()
    {
        return $this->belongsTo(AmmunitionNomenclature::class, 'ammunition_nomenclature_id', 'id');
    }

    public function stockCard()
    {
        return $this->hasOne(StockCard::class, 'inventory_id', 'id');
    }

    public function getDescriptionAttribute()
    {
        $sizeCaliber = $this->ammunitionNomenclature ? $this->ammunitionNomenclature->ammunitionSizeCaliber->name : null;
        $category = $this->ammunitionNomenclature ? $this->ammunitionNomenclature->ammunitionCategory->name : null;
        $type = $this->ammunitionNomenclature ? $this->ammunitionNomenclature->ammunitionType->name : null;

        return $category.','.$sizeCaliber.','.$type;
    }
}