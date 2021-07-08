<?php

namespace App\Http\Controllers\Year2019;

use App\Http\Controllers\BaseAppHomeController;
use App\Http\Controllers\ApiTrait;

class AppHomeController extends BaseAppHomeController
{
    use ApiTrait;

    protected $year = 2019;
}
