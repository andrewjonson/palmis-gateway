<?php

namespace App\Models\v1\References;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicingFpao extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];
    protected $table = 'rf_servicing_fpaos';
}