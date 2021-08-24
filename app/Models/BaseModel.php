<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

abstract class BaseModel extends Model
{
    use Cachable;
}