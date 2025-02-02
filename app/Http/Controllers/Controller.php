<?php

namespace App\Http\Controllers;

use App\Helper\AutoSync;
use App\Helper\DateRange;
use App\Helper\PrinterThermal;
use App\Helper\QueueNumber;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, AutoSync, DateRange, DispatchesJobs, PrinterThermal, QueueNumber, ValidatesRequests;
}
