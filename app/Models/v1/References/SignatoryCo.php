<?php

namespace App\Models\v1\References;

use App\Models\BaseModel;
// use App\Traits\ModularTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class SignatoryCo extends BaseModel
{
    // use ModularTrait;
    use SoftDeletes;

    protected $table = 'rf_signatory_co';
    protected $fillable = [
        'signatory_id',
        'co_id'
    ];

    public function signatory()
    {
        return $this->belongsTo(Signatory::class, 'signatory_id');
    }

    public function co()
    {
        return $this->belongsTo(Signatory::class, 'co_id');
    }
}