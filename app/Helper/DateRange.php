<?php

namespace App\Helper;

use Carbon\Carbon;

trait DateRange
{
    public function getfromToDateRange($dateRangeInput)
    {
        abort_if($dateRangeInput === '', 422, 'Not Valid Date range!');
        $formated = explode(' ', $dateRangeInput);
        if ($formated[0] == "") {
            $from = now()->subDays(5);
            $to = now();
        } else {
            $from = $formated[0];
            $to = $formated[2];
        }
        return [Carbon::parse($from), Carbon::parse($to)];
    }
}
