<?php

namespace App\Models\v1\References;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmmunitionHeadStumpMarking extends BaseModel
{
    // use ModularTrait;
    use SoftDeletes;

    protected $fillable = ['name', 'description'];
    protected $table = 'rf_ammunition_head_stump_markings';
}