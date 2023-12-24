<?php

namespace Hexlet\Php\LengthOfLastWord;

function lengthOfLastWord(string $str)
{
    $newStr = trim($str);
    $words = explode(" ", $newStr);
    return strlen($words[count($words) - 1]);
}

echo lengthOfLastWord('') . "\n"; // 0

echo lengthOfLastWord('man in BlacK') . "\n"; // 5

echo lengthOfLastWord('hello, world!  ') . "\n"; // 6