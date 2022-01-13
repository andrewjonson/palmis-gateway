<?php

namespace App\Models\v1\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'description'];
    protected $table = 'rf_countries';
}