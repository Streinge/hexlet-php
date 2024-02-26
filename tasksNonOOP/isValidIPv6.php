<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Funct\Collection\flattenAll;
use function Funct\Collection\every;

const HEXADECIMAL = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];

function isCorrectSize(array $arrayHextet): bool
{
    return count($arrayHextet) < 9;
}

function isCorrectEdges(string $address): bool
{
    $firstChar = $address[0];
    $lastChar = $address[-1];
    $begin = substr($address, 0, 2);
    $end = substr($address, -2);
    $beginCondition = in_array($firstChar, HEXADECIMAL) || $begin === '::';
    $endCondition = in_array($lastChar, HEXADECIMAL) || $end === '::';
    if ($beginCondition && $endCondition) {
        return true;
    }
    return false;
}

function isHexadecimalOrEmpty(array $numbers): bool
{
    $HexadecimalWithEmptyString = array_merge(HEXADECIMAL, ['']);
    return every($numbers, fn($value) => in_array($value, $HexadecimalWithEmptyString));
}

function isCorrectLength(array $hextet): bool
{
    return every($hextet, fn($value) => (strlen($value) < 5));
}

function isCorrectNumberColons(string $lowerAddress): bool
{
    $numberOneColon = substr_count($lowerAddress, ':');
    $numberTwoColons = substr_count($lowerAddress, '::');
    $numberThreeColons = substr_count($lowerAddress, ':::');
    if (($numberThreeColons > 0 || $numberTwoColons > 1) || ($numberOneColon === 0 && $numberTwoColons === 0)) {
        return false;
    }
    return true;
}

function isValidIPv6(string $address)
{
    $lowerAddress = strtolower($address);
    $arrayAddress = explode(":", $lowerAddress);
    $arrayChars = flattenAll(array_map(fn($address) => str_split($address), $arrayAddress));
    $logicValues = [
        isCorrectEdges($lowerAddress),
        isHexadecimalOrEmpty($arrayChars),
        isCorrectLength($arrayAddress),
        isCorrectSize($arrayAddress),
        isCorrectNumberColons($lowerAddress)
    ];
    if (in_array(false, $logicValues)) {
        return false;
    }
    return true;
}

//var_dump(isValidIPv6('2a02:0cb41:0:0:0:0:0:7')); // false
//var_dump(isValidIPv6('1::1:')); // false
//var_dump(isValidIPv6(':1::1')); // false
//var_dump(isValidIPv6('5c03:0:a::b825:d690:4ce0:2831:acf0')); // false
//var_dump(isValidIPv6('d:0:4:a004:3b96:10b0:10:800:15')); // false
//var_dump(isValidIPv6('C00D::a2195:2EA9:096')); // false
//var_dump(isValidIPv6('e1b6:1daf9:6:0:c50:8c4:90e:e')); // false
//var_dump(isValidIPv6('9f8:0:69S0:9:9:d9a:672:f90d')); // false
//var_dump(isValidIPv6('2.001::')); // false
//var_dump(isValidIPv6('2001:::')); // false
//var_dump(isValidIPv6('2001')); // false
//var_dump(isValidIPv6('2001::0:64::2')); // false
//var_dump(isValidIPv6('2607:G8B0:4010:801::1004')); //false
//var_dump(isValidIPv6('2a03:2880:2130:cf05:face:b00c:0:1')); //true
//var_dump(isValidIPv6('::b36:3c:f0:7:937')); //true
//var_dump(isValidIPv6('000::B36:3C:00F0:7:937')); //true
//var_dump(isValidIPv6('0B0:0F09:7f05:e2F3:0D:0:e0:7000')); //true
//var_dump(isValidIPv6('10:d3:2d06:24:400c:5ee0:be:3d')); //true
//var_dump(isValidIPv6('::')); //true
//var_dump(isValidIPv6('::1')); //true
//var_dump(isValidIPv6('1::1')); //true
//var_dump(isValidIPv6('2a02:cb41:0:0:0:0:0:7')); //true
//var_dump(isValidIPv6('e:6c::647:50:0:7')); //true
//var_dump(isValidIPv6('1001:208:67:4f00:e3::2c6:0')); //true
//var_dump(isValidIPv6('04:07A1:1404:0A0:A:080F:080:0')); //true
