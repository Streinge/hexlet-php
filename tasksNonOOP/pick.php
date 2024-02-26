<?php

namespace Hexlet\Php;

function pick(array $items, array $testKeys): array
{
    $result = [];
    foreach ($testKeys as $testkey) {
        foreach ($items as $key => $value) {
            if ($key === $testkey) {
                $result[$key] = $value;
            }
        }
    }
    return $result;
}
$data = [
    'user' => 'ubuntu',
    'cores' => 4,
    'os' => 'linux',
    'null' => null
];
var_dump(pick($data, ['user']));       // → ['user' => 'ubuntu']
var_dump(pick($data, ['user', 'os'])); // → ['user' => 'ubuntu', 'os' => 'linux']
var_dump(pick($data, []));             // → []
var_dump(pick($data, ['none']));       // → []
var_dump(pick($data, ['null']));        // → ['null' => null]
