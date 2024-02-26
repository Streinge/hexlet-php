<?php

namespace Hexlet\Php\BubbleSort;

function bubbleSort(array $items): array
{
    $size = count($items);
    do {
        for ($i = 0; $i < $size - 1; $i++) {
            if ($items[$i] > $items[$i + 1]) {
                $temp = $items[$i];
                $items[$i] = $items[$i + 1];
                $items[$i + 1] = $temp;
            }
        }
        $size--;        
    } while ($size >= 1);
    return $items;
}

print_r(bubbleSort([])); // []
print_r(bubbleSort([3, 10, 4, 3])); // [3, 3, 4, 10]
