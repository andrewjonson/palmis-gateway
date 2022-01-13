<?php

namespace App\Models\v1\Dashboard;

use App\Models\BaseModel;
// use App\Traits\ModularTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dashboard extends BaseModel
{
    // use ModularTrait;
    use SoftDeletes;

    protected $fillable = [];
    protected $table = '';
}