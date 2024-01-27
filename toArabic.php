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


function toArabic(string $record)
{
    $keys = array_keys(NUMERALS);
    $copyRecord = $record;
    $result = 0;
    foreach ($keys as $key) {
        $length = strlen($key);
        $testStr = substr($copyRecord, 0, $length);
        $count = 0;
        while ($testStr === $key) {
            if ($count === 3) {
                return false;
            }
            $result += NUMERALS[$key];
            $copyRecord = substr($copyRecord, $length);
            $testStr = substr($copyRecord, 0, $length);
            $count++;
        }
    }
    return (empty($testStr)) ? $result : false;
}
