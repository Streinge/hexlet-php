<?php

namespace App\Dates;

// BEGIN
function buildRange($dates, $begin, $end)
{
    $datesByDate = collect($dates)->keyBy('date');
    $period = \Carbon\CarbonPeriod::create($begin, $end);
    $periodAsColl = collect($period);
    $resultAsColl = $periodAsColl->map(function ($day) use ($datesByDate) {
        $date = $day->format('d.m.Y');
        return $datesByDate[$date] ?? [ 'date' => $date, 'value' => 0 ];
    });
    return $resultAsColl->toArray();
}
// END

