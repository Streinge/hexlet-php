<?php

namespace Hexlet\Php\SumIntervals;

function sumIntervals(array $intervals)
{
    $copyIntervals = $intervals;
    sort($copyIntervals);
    $newIntervals = [];
    $length = count($copyIntervals);
    for ($i = 0; $i < $length; $i++) {
        [$begin, $end] = $copyIntervals[$i];
        if ($begin !== $end) $newIntervals[] = range($begin, $end);
    }
    if (empty($newIntervals)) return 0;
    $testInterval = $newIntervals[0];
    $sum = 0;
    $length = count($newIntervals);
    for ($i = 1; $i < $length; $i++) {
        if (array_intersect($testInterval, $newIntervals[$i])) {
            $testInterval = array_unique(array_merge($testInterval, $newIntervals[$i]));
        } else {
            $sum +=  array_pop($testInterval) - array_shift($testInterval);
            $testInterval = $newIntervals[$i];
        }
    }
    $sum +=  array_pop($testInterval) - array_shift($testInterval);
    return $sum;
}
$intervals = [
    [1, 2],
    [11, 12]
];
var_dump(sumIntervals($intervals));


