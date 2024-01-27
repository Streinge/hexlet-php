<?php

namespace Hexlet\Php\Swap;

function swap(array $items, int $index): array
{
    $result = $items;
    if (array_key_exists($index - 1, $result) && array_key_exists($index + 1, $result)) {
        $temp = $result[$index - 1];
        $result[$index - 1] = $result[$index + 1];
        $result[$index + 1] = $temp;
    }
    return $result;
}

$names = ['john', 'smith', 'karl'];
 
$result = swap($names, 1);
print_r($result); // => ['karl', 'smith', 'john']
 
$result = swap($names, 2);
print_r($result); // => ['john', 'smith', 'karl']
 
$result = swap($names, 0);
print_r($result); // => ['john', 'smith', 'karl']
