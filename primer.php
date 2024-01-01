<?php

function isAssoc(array $items)
{
    if ($items === []) return false;
    var_dump(array_keys($items));
    var_dump(range(0, count($items) - 1));
    return array_keys($items) !== range(0, count($items) - 1);
}

var_dump(isAssoc(['a', 'b', 'c'])); // false
var_dump(isAssoc(['0' => 'a', '1' => 'b', '2' => 'c'])); // true
