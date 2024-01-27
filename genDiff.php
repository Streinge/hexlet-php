<?php

namespace Hexlet\Php;

function genDiff(array $first, array $second): array
{
    $mergeArrays = array_merge($first, $second);
    $keysMerge = array_keys($mergeArrays);
    $result = [];
    foreach ($keysMerge as $key1) {
        if (array_key_exists($key1, $first) && array_key_exists($key1, $second)) {
            $result[$key1] = ($first[$key1] === $second[$key1]) ? 'unchanged' : 'changed';
        } elseif (array_key_exists($key1, $first)) {
            $result[$key1] = 'deleted';
        } else {
            $result[$key1] = 'added';
        }
    }
    return $result;
}
