<?php

namespace Hexlet\Php\AddDigits;

function addDigits(int $number): int
{
    $str_number = (string) $number;
    while (strlen($str_number) >= 2) {
        $sum = 0;
        for ($i = 0; $i < strlen($str_number); $i++) {
            $sum = $sum + (int) $str_number[$i];
        }
        $str_number = (string) $sum;
    }

    return (int) $str_number;
}

echo addDigits(38);