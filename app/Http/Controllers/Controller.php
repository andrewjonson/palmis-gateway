<?php

namespace App\Http\Controllers;

use App\Traits\RestfulControllerTrait;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use RestfulControllerTrait;
}
