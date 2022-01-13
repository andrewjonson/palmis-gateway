<?php

namespace App\Models\v1\References;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'psgc_code',
        'province_description',
        'region_code',
        'province_code',
        'province_id'
    ];

    protected $table = 'rf_provinces';

    public function region() {
        return $this->belongsTo(Region::class, 'region_code', 'region_code');
    }
}