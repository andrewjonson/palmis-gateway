<?php

namespace App\Models\v1\References;

use App\Models\BaseModel;
// use App\Traits\ModularTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocSetting extends BaseModel
{
    // use ModularTrait;
    use SoftDeletes;

    protected $table = 'rf_doc_settings';
    protected $fillable = [
        'logo',
        'header'
    ];
}