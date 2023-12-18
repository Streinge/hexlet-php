<?php

namespace Hexlet\Php\GetSameParity;

function getSameParity(array $items): array
{
    if (empty($items)) {
        return [];
    }

    $newItems = [];
    $isEvenFirst = ($items[0] % 2 === 0);

    foreach ($items as $item) {
        $isEven = ($item % 2 === 0);
        if ($isEven  === $isEvenFirst) {
            $newItems[] = $item;
        }
    }

    return $newItems;
}

print_r(getSameParity([]));        // []
print_r(getSameParity([1, 2, 3]));// [1, 3]
print_r(getSameParity([1, 2, 8])); // [1]
print_r(getSameParity([2, 2, 8])); // [2, 2, 8]
