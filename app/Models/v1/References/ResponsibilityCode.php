<?php

namespace App\Models\v1\References;

use App\Models\BaseModel;
// use App\Traits\ModularTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResponsibilityCode extends BaseModel
{
    // use ModularTrait;
    use SoftDeletes;

    protected $fillable = ['name', 'description'];
    protected $table = 'rf_responsibility_codes';
}