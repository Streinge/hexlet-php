<?php

namespace Hexlet\Php\HammingWeight;

function hammingWeight($number)
{
    $array = str_split(decbin($number));
    // array_filter без параметров убирает все значения
    // которые трактует, как false в том числе и 
    // строку "0"
    return count(array_filter($array));
}

var_dump(hammingWeight(0));
