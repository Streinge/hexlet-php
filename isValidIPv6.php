<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Funct\Collection\flattenAll;
use function Funct\Collection\every;

function isCorrectEnd(string $address): bool
{
    $arr = [];
    return empty($arr);
}

function isHexadecimal(array $numbers): bool
{
    $Hexadecimal = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e'];
    return every($numbers, fn($value) => in_array($value, $Hexadecimal));
}

function isCorrectLength(array $hextet): bool
{
    return every($hextet, fn($value) => (strlen($value) < 5));
}
function isValidIPv6(string $address)
{
    if ($address === "::") {
        return true;
    }
    $lowerAddress = strtolower($address);
    $arrayAddress = explode(":", $lowerAddress);
    $arrayChars = flattenAll(array_map(fn($address) => str_split($address), $arrayAddress));
    if (!isHexadecimal($arrayChars) || !isCorrectLength($arrayAddress)) {
        return false;
    }
    return $arrayChars;
}

var_dump(isValidIPv6('2a02:0cb41:0:0:0:0:0:7'));
