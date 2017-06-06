<?php

namespace Sandbox\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Sandbox\Traits\DispatchFrom;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, DispatchFrom, ValidatesRequests;
}
