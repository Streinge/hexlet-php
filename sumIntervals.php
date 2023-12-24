<?php

namespace Hexlet\Php\SumIntervals;

function sumIntervals(array $intervals)
{
    $newIntervals = [];
    $length = count($intervals);
    for ($i = 0; $i < $length; $i++) {
        [$begin, $end] = $intervals[$i];
        $newIntervals[] = range($begin, $end);
    }
    for ($i = 0; $i < $length; $i++) {
        if(array_intersect()
    }
    return array_merge($newIntervals);
}
$intervals = [[1,4], [7, 12], [3, 6]];
var_dump(sumIntervals($intervals));


