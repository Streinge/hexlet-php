<?php

namespace Hexlet\Php\GetIntersectionOfSortedArray;

function getIntersectionOfSortedArray(array $array1, array $array2): array
{
    $result = [];
    $min = 0;
    for ($i = 0, $size1 = count($array1); $i < $size1; $i++) {
        for ($j = $min, $size2 = count($array2); $j < $size2; $j++) {
            if ($array1[$i] === $array2[$j]) {
                $result[] = $array1[$i];
                $min = $j + 1;
                break;
            }
        }
    }
    return $result;
}

print_r(getIntersectionOfSortedArray([10, 11, 24], [10, 13, 14, 18, 24, 30])); // [10, 24]
 
print_r(getIntersectionOfSortedArray([10, 11, 24], [-2, 3, 4])); // []
 
print_r(getIntersectionOfSortedArray([], [2])); // []
