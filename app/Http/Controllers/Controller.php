<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as baseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
abstract class Controller extends baseController
{
     use AuthorizesRequests;
}
