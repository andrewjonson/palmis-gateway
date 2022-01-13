<?php

namespace App\Models\v1\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Make extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];
    protected $table = 'rf_makes';
}