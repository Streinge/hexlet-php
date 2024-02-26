<?php

namespace Hexlet\Php;

function getSameParity(array $data): array
{
    if ($data === []) {
        return [];
    }
    $parity = $data[0] % 2 === 0;
    return array_values(array_filter($data, function ($item) use ($parity) {
        if (($item % 2 === 0) === $parity) {
            if ($item === 0) {
                return true;
            }
            return $item;
        }
    }));
}

//var_dump(getSameParity([])); // [])
//var_dump(getSameParity([-1, 0, 1, -3, 10, -2])); // [-1, 1, -3]
//var_dump(getSameParity([2, 0, 1, -3, 10, -2])); //[2, 0, 10, -2]
//var_dump(getSameParity([2, 0, 10, -2])); // [2, 0, 10, -2]
//var_dump(getSameParity([-5, 0, 1, -3, 10]));// [-5, 1, -3]
var_dump(getSameParity([5, 0, 1, -3, 10])); // [5, 1, -3]
