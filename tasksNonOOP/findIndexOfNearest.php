<?php

namespace Hexlet\Php;

function findIndexOfNearest(array $numbers, $testNumber)
{
    $difference = array_map(fn($num) => abs($testNumber - $num), $numbers);
    $index = array_filter(array_keys($difference), fn($index) => min($difference) === $difference[$index]);
    return ($numbers !== []) ? min($index) : null;
}

//var_dump(findIndexOfNearest([15, 10, 3, 4], 0)); // 2
//var_dump(findIndexOfNearest([], 2)); // null
//var_dump(findIndexOfNearest([10], 0)); // 0
//var_dump(findIndexOfNearest([10, 15], 20)); // 1
//var_dump(findIndexOfNearest([15, 10, 3, -5], 1)); // 2
var_dump(findIndexOfNearest([15, 10, 3, -5], -1)); // 2
//var_dump(findIndexOfNearest([15, 10, 3, -5], -2)); // 3
