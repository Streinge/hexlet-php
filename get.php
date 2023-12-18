<?php

namespace Hexlet\Php\Get;

function get(array $items, int $index, $default = null)
{
    if (array_key_exists($index, $items)) {
        return $items[$index];
    } else {
        return $default; 
    }
    
}
$cities = ['moscow', 'london', 'berlin', 'porto', null];

echo get($cities, 1)."\n"; // london
echo get($cities, 10, 'paris')."\n"; // paris
var_dump(get($cities, 4)); // null
var_dump(get($cities, 4, 'default')); // null
