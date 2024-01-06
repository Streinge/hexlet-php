<?php

namespace Hexlet\Php;

use function Funct\Collection\flattenAll;

function calculateProbabilities(array $numbers)
{
    $first = $numbers[0];
    $arrayFIg = array_map(function ($key) use ($first, $numbers) {
        if ($numbers[$key] === $first) {
            return $numbers[$key + 1];
        }
    }, array_keys($numbers));
    return $arrayFIg;
}

var_dump(calculateProbabilities([1, 3, 1, 5, 1, 2, 5, 6, 2, 5, 2, 6, 4, 4]));
