<?php

$intervals = [
    [1, 5],
    [-10, 19],
    [1, 7],
    [16, 100],
    [5, 11],
    [-11, 100]
];
$newIntervals = [];
$length = count($intervals);
for ($i = 0; $i < $length; $i++) {
    [$begin, $end] = $intervals[$i];
    $newIntervals[] = range($begin, $end);
}

$y = [1,3,-7, 4,100, 0];
sort($y);
var_dump($y);


