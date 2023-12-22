<?php

namespace Hexlet\Php\GetLongestLength;

function findsSubstring(string $str): string
{
    echo "Строка ". $str . "\n";
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
    if (strlen($str) === 1) {
        return $str;
    }
    $lengthString = strlen($str);
    for ($i = 0; $i < $lengthString; $i++) {
        // echo "i = ". $i . "\n";
        $firstChar = $str[$i];
        // echo "firstChar = ". $firstChar . "\n";
        $sliceStr = substr($str, $i + 1);
        // echo "sliceStr = ". $sliceStr . "\n";
        $lengthSlice = strlen($sliceStr);
        $uniqueString = $firstChar;
        for ($j = 0; $j < $lengthSlice; $j++) {
            if ($sliceStr[$j] !== $firstChar) {
                $uniqueString .= "$sliceStr[$j]";
            } else {
                break;
            }
        }
        echo getLongestLength($uniqueString) . "\n";
    }
}
$str = 'qweqrty';
echo getLongestLength($str) . "\n";
