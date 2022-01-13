<?php

namespace App\Models\v1\References;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class FpaoUnit extends BaseModel
{
    // use ModularTrait;
    use SoftDeletes;

    protected $fillable = ['fpao_id', 'unit'];
    protected $table = 'rf_fpao_units';

    public function fpao()
    {
        return $this->belongsTo(Fpao::class, 'fpao_id', 'id');
    }
}