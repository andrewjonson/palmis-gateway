<?php

namespace App\Models\v1\References;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signatory extends Model
{
    use SoftDeletes;

    protected $table = 'rf_signatories';
    protected $fillable = [
        'pmcode',
        'name',  
        'rank', 
        'designation',
        'unit', 
        'position_office',
        'afposmos'
    ];
}