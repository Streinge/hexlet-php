<?php

namespace Hexlet\Php;

function removeFirstLevel(array $data)
{
    $result = [];
    foreach ($data as $node) {
        if (is_array($node)) {
            foreach ($node as $elem) {
                $result[] = $elem;
            }
        }
    }
    return $result;
}
$tree = []; 
var_dump(removeFirstLevel($tree)); // []

$tree1 = [[5], 1, [3, 4]]; 
var_dump(removeFirstLevel($tree1)); // [5, 3, 4]

$tree2 = [1, 2, [3, 5], [[4, 3], 2]];
var_dump(removeFirstLevel($tree2)); // [3, 5, [4, 3], 2]