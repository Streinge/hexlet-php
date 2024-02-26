<?php

namespace Hexlet\Php;

function toRna(string $dnk): string
{
    $changeArray = [
        'G' => 'C',
        'C' => 'G',
        'T' => 'A',
        'A' => 'U'
    ];
    $dnkArray = str_split($dnk);
    $result = [];
    foreach ($dnkArray as $item) {
        $result[] = $changeArray[$item];
    }
    $result = implode($result);
    return $result;
}
