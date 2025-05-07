<?php

namespace App\Services;

use Carbon\Carbon;

class DateService extends BaseService
{
    public function getWeekday($today)
    {

        $today = Carbon::parse($today);

        $startOfWeek = $today->startOfWeek();
        $daysOfWeek = [];

        for ($i = 0; $i < 7; $i++)
            $daysOfWeek[] = $startOfWeek->copy()->addDays($i)->format('Y-m-d');

        return $daysOfWeek;
    }
}
