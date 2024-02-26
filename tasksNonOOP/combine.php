<?php

namespace Hexlet\Php;

function combine(array $arrays): array
{
    $result = [];
    foreach ($arrays as $arr) {
        foreach ($arr as $key => $value) {
            if (empty($result[$key]) || !in_array($value, $result[$key])) {
                $result[$key][] = $value;
            }
        }
    }
    return $result;
}
