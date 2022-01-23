<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Traits\ModularTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rsmi extends BaseModel
{
    use ModularTrait;
    use SoftDeletes;

    protected $fillable = [];
    protected $table = '';
}