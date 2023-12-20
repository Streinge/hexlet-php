<?php

namespace Hexlet\Php\Flatten;

function flatten(array $items): array
{
    $result = [];
    foreach ($items as $item) {
        if (is_array($item)) {
            $result = [...$result, ...$item];
        } else {
            $result[] = $item;
        }

    }
    return $result;
}
print_r(flatten([])); // []
print_r(flatten([1, [3, 2], 9])); // [1, 3, 2, 9]
print_r(flatten([1, [[2], [3]], [9]])); // [1, [2], [3], 9]
