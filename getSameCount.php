<?php

namespace Hexlet\Php\GetSameCount;

function getSameCount(array $array1, array $array2): int
{
    $result1 = array_unique($array1);
    $result2 = array_unique($array2);
    $counter = 0;
    foreach ($result1 as $res) {
        if (in_array($res, $result2)) {
            $counter++;
        }
    }
    return $counter;
}

echo getSameCount([], []) . "\n"; // 0
echo getSameCount([4, 4], [4, 4]) . "\n"; // 1
echo getSameCount([1, 10, 3], [10, 100, 35, 1]) . "\n"; // 2
echo getSameCount([1, 3, 2, 2], [3, 1, 1, 2]) . "\n"; // 3
