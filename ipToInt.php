<?php

namespace Hexlet\Php;

function ipToInt(string $address): int
{
    $numArray = explode(".", $address);
    $count = 4;
    $powNumber = array_map(function ($num) use (&$count) {
        $count--;
        return $num * (256 ** $count);
    }, $numArray);
    return array_sum($powNumber);
}

function intToIp(int $number)
{
    $new = $number;
    $array = range(0, 3);
    $divisor = 256 ** 3;
    $arrayDischarges = array_reduce($array, function ($acc) use (&$new, &$divisor) {
        $acc[] = intdiv($new, $divisor);
        $new = $new - intdiv($new, $divisor) * $divisor;
        $divisor = ($divisor > 256) ? $divisor / 256 : 1;
        return $acc;
    }, []);
    return implode(".", $arrayDischarges);
}

var_dump(intToIp(167801600));
//var_dump(ipToInt('10.0.115.0'));
//[0, '0.0.0.0'],
//[4294967295, '255.255.255.255'],
//[32, '0.0.0.32'],
//[2149583361, '128.32.10.1'],
//[2154959208, '128.114.17.104'],
//[3221225584, '192.0.0.112'],
//[167801600, '10.0.115.0']
