<?php

namespace Hexlet\Php;

// BEGIN
function pick(array $data, array $keys)
{
    $result = [];
    foreach ($keys as $key) {
        // здесь получается нет необходимости проверять циклом
        // наличие второго ключа, для этого есть функция
        // array_key_exists - если есть ключ, то берем его и значение
        // и сразу заносим в результирующий массив
        if (array_key_exists($key, $data)) {
            $result[$key] = $data[$key];
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
