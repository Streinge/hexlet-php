<?php

namespace Hexlet\Php;

// BEGIN
function removeFirstLevel($tree)
{
    // до этой фильтрации я догадался, что надо брать из первого
    // уровня только массивы
    $nodes = array_filter($tree, fn($node) => is_array($node));
    // а здесь с помощью оператора распаковки массивов и передачи
    // и их слияния получается нужный результат
    return array_merge(...$nodes);
}
// END

$tree = []; 
var_dump(removeFirstLevel($tree)); // []

$tree1 = [[5], 1, [3, 4]]; 
var_dump(removeFirstLevel($tree1)); // [5, 3, 4]

$tree2 = [1, 2, [3, 5], [[4, 3], 2]];
var_dump(removeFirstLevel($tree2)); // [3, 5, [4, 3], 2]