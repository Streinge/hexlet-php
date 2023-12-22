<?php

namespace Hexlet\Php\GetLongestLength;

function findsSubstring(string $str)
{
    if (strlen($str) === 1) {
        return $str;
    }
    $firstChar = $str[0];
    $substr = $firstChar;
    $size = strlen($str);
    for ($i = 1; $i < $size; $i++) {
        if ($str[$i] === $firstChar) {
            return findsSubstring(substr($substr, 1));
        } else {
            $substr .= "{$str[$i]}";
        }
    }
    return $substr;
}

function getLongestLength(string $str)
{
    $char = $str[0];
    $substr = findsSubstring($str);

    return $substr;
}

$str = 'qweqrty';
echo getLongestLength($str) . "\n";
