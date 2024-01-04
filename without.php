<?php

namespace Hexlet\Php;

function without(array $items, ...$numbers)
{
    $filtered = array_filter($items, function ($item) use ($numbers) {
        var_dump($item);
        var_dump($numbers);
        return $item !== $numbers;
    });
    // Сбрасываем ключи
    return array_values($filtered);
}


var_dump(without([3, 4, 10, 4, 'true'], 4)); // [3, 10, 'true']
var_dump(without(['3', 2], 0, 5, 11)); // ['3', 2]
