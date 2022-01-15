<?php

namespace App\Models\v1\References;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmmunitionNomenclature extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'ammunition_name',
        'ammunition_category_id',
        'ammunition_size_caliber_id',
        'ammunition_type_id',
        'ammunition_uom_id',
        'ammunition_classification_id',
        'ammunition_supply_id',
        'ammunition_detail_id',
        'ammunition_head_stump_marking_id',
        'ammunition_article_id'
    ];
    protected $table = 'rf_ammunition_nomenclatures';

    public function ammunitionCategory()
    {
        return $this->belongsTo(AmmunitionCategory::class, 'ammunition_category_id', 'id');
    }

    public function ammunitionSizeCaliber()
    {
        return $this->belongsTo(AmmunitionSizeCaliber::class, 'ammunition_size_caliber_id', 'id');
    }
    
    public function ammunitionType()
    {
        return $this->belongsTo(AmmunitionType::class, 'ammunition_type_id', 'id');
    }

    public function ammunitionUom()
    {
        return $this->belongsTo(AmmunitionUom::class, 'ammunition_uom_id', 'id');
    }

    public function ammunitionClassification()
    {
        return $this->belongsTo(AmmunitionClassification::class, 'ammunition_classification_id', 'id');
    }

    public function ammunitionSupply()
    {
        return $this->belongsTo(AmmunitionSupply::class, 'ammunition_supply_id', 'id');
    }

    public function ammunitionDetail()
    {
        return $this->belongsTo(AmmunitionDetail::class, 'ammunition_detail_id', 'id');
    }

    public function ammunitionHeadStumpMarking()
    {
        return $this->belongsTo(AmmunitionHeadStumpMarking::class, 'ammunition_head_stump_marking_id', 'id');
    }

    public function ammunitionArticle()
    {
        return $this->belongsTo(AmmunitionArticle::class, 'ammunition_article_id');
    }
}