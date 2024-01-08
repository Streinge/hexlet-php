<?php

namespace Hexlet\Php;

function ipToInt(string $address)
{
    $numArray = explode(".", $address);
    $count = 4;
    $powNumber = array_map(function ($num) use (&$count) {
        $count--;
        return $num * (256 ** $count);
    }, $numArray);
    return $powNumber;
}

var_dump(ipToInt('128.32.10.1'));