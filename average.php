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
