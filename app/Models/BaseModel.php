<?php 

namespace App\Models;

use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

abstract class BaseModel extends Model implements ShouldQueue
{
    use Cachable, InteractsWithQueue, SerializesModels;
}