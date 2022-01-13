<?php

namespace App\Models\v1\Transactions;

use Illuminate\Database\Eloquent\Model;

class SignatoryTallyIn extends Model
{
    protected $fillable = [
        'tally_in_id', 
        'signatory_id'
    ];
    protected $table = 'tr_signatory_tally_ins';
}