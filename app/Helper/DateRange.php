<?php

namespace App\Helper;

trait DateRange
{
    public function getfromToDateRange($dateRangeInput)
    {
        abort_if($dateRangeInput === '', 422, 'Not Valid Date range!');
        $formated = explode(' ', $dateRangeInput);
        if ($formated[0] == "") {
            return false;
        } else {
            return [$formated[0], $formated[2]];
        }
    }
}
