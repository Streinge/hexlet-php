<?php

namespace Hexlet\Php;

function flatten($list)
{
    $dfs = function ($acc, $item) use (&$dfs) {

        $newAcc = (is_array($item)) ? array_reduce($item, $dfs, []) : [];

        if (!is_array($item)) {
            $acc[] = $item;
        }

        $acc = (!empty($newAcc)) ? [...$acc, ...$newAcc] : $acc;

        return $acc;
    };

    $result = array_reduce($list, $dfs, []);

    return $result;
}

$list = [1, 2, [3, 5], [[4, 3], 2]];
$expected = [1, 2, 3, 5, 4, 3, 2];
var_dump(flatten($list) === $expected);
var_dump(flatten([]) === []);
var_dump(flatten([1, 2, [3, 5], [[4, 3], 4], 10]) === [1, 2, 3, 5, 4, 3, 4, 10]);
var_dump(flatten([[1, [5], [], [[-3, 'hi']]], 'string', 10, [[[5]]]]) === [1, 5, -3, 'hi', 'string', 10, 5]);
var_dump(flatten([null, '\n', [[true => false]]]) === [null, '\n', false]);
