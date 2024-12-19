<?php

namespace App\Helper;

use App\Traits\NepaliDateConverter;

class HelperClass
{
    use NepaliDateConverter;

    public function getTodayNepaliDate(): string
    {
        $nepaliDate = $this->get_nepali_date(today()->format('Y'),today()->format('m'),today()->format('d'));
        return get_nepali_number($nepaliDate['y'].' साल '. $nepaliDate['M']." ". $nepaliDate['d'].' गते, '.$nepaliDate['l']);

    }
}
