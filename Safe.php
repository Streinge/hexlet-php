<?php

namespace Hexlet\Php;

function json_decode(string $json, bool $assoc = false)
{
    $array1 = \json_decode($json, $assoc);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new \Exception("'{$json}' is not correct!");
    }
    return $array1;
}

$data = json_decode('{ key": "value" }', true);
print_r($data);
