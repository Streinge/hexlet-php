<?php

namespace Hexlet\Php;

function findWhere(array $data, array $query)
{
    foreach ($data as $arr) {
        var_dump($arr);
        foreach ($query as $key => $value) {
            var_dump(array_key_exists($key, $arr));
            var_dump($arr[$key] === $value);
            if (!array_key_exists($key, $arr) || $arr[$key] !== $value) {
                break;
            } elseif (array_key_last($query) === $key) {
                return $arr;
            }
        }
    }
    return null;
}
