<?php

namespace Hexlet\Php;

use stdClass;

function toStd(array $date)
{
    $obj = new stdClass();
    foreach ($date as $key => $value) {
        $obj->$key = $value;
    }
    return $obj;
}

$data = [
    'key' => 'value',
    'key2' => 'value2',
];
$config = toStd($data);

var_dump($config->key); // value
var_dump($config->key2); // value2
var_dump($config);