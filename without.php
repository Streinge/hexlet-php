<?php

namespace Hexlet\Php;

function without(array $items, ...$numbers)
{
    $filtered = $items;
    foreach ($numbers as $number) {
        $filtered = array_filter($filtered, function ($filters) use ($number) {
            return $filters !== $number;
        });
    }
    return array_values($filtered);
}


// var_dump(without([3, 4, 10, 4, 'true'], 4)); // [3, 10, 'true']
// var_dump(without(['3', 2], 0, 5, 11)); // ['3', 2]
// var_dump(without(['wow', 3, 4, 10, 4, 'true'], null, 4)); //['wow', 3, 10, 'true']
