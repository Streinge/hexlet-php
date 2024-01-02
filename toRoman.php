<?php

namespace Hexlet\Php;

const NUMERALS = [
    "M" => 1000,
    "CM" => 900,
    "D" => 500,
    "CD" => 400,
    "C" => 100,
    "XC" => 90,
    "L" => 50,
    "XL" => 40,
    "X" => 10,
    "IX" => 9,
    "V" => 5,
    "IV" => 4,
    "I" => 1,
];

function toRoman(int $number)
{
    $keys = array_keys(NUMERALS);
    $copyNumber = $number;
    $result = '';
    foreach ($keys as $key) {
        while ($copyNumber >= (int) NUMERALS[$key]) {
            $copyNumber -= (int) NUMERALS[$key];
            $result .= "{$key}";
        }
    }
    return $result;
}
