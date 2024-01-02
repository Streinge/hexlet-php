<?php

namespace Hexlet\Php;

function average(...$numbers)
{
    if ($numbers === []) {
        return null;
    }
    $sum = 0;
    foreach ($numbers as $num) {
        $sum += $num;
    }
    return $sum / count($numbers);
}

var_dump(average(0)); // 0
var_dump(average(0, 10)); // 5
var_dump(average(-3, 4, 2, 10)); // 3.25
var_dump(average()); // null
