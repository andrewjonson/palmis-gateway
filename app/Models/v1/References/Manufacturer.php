<?php

namespace App\Models\v1\References;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];
    protected $table = 'rf_manufacturers';
}