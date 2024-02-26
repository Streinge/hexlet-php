<?php

namespace Hexlet\Php;

function getIn(array $items, array $keys)
{
    $result = $items;
    foreach ($keys as $key) {
        echo "key = \n";
        var_dump($key);
        if (!is_array($result)) {
            return null;
        }
        if (array_key_exists($key, $result)) {
            $result = $result[$key];
            echo "result = \n";
            var_dump($result);
        } else {
            return null;
        }
    }
    return $result;
}
$data = [
    'user' => 'ubuntu',
    'hosts' => [
        ['name' => 'web1'],
        ['name' => 'web2', null => 3, 'active' => false]
    ]
];

//var_dump(getIn($data, ['undefined'])); // null
//var_dump(getIn($data, ['user'])); // 'ubuntu'
//var_dump(getIn($data, ['user', 'ubuntu'])); // null
//var_dump(getIn($data, ['hosts', 1, 'name'])); // 'web2'
//var_dump(getIn($data, ['hosts', 0])); // ['name' => 'web1']
//var_dump(getIn($data, ['hosts', 1, null])); // 3
var_dump(getIn($data, ['hosts', 1, 'active'])); // false
