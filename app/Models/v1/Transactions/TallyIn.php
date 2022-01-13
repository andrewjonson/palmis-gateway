<?php

namespace App\Models\v1\Transactions;

use App\Models\v1\Transactions\Iar;
use App\Models\v1\References\Supplier;
use Illuminate\Database\Eloquent\Model;
use App\Models\v1\Transactions\Inventory;

class TallyIn extends Model
{
    protected $fillable = [
        'tally_in_nr', 
        'tally_in_date',
        'supplier_id',
        'supplier_name',
        'supplier_designation',
        'is_iar',
        'stock_disposition'
    ];
    protected $table = 'tr_tally_ins';

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'tally_in_id', 'id');
    }

    public function iar()
    {
        return $this->hasOne(Iar::class, 'tally_in_id', 'id');
    }
}