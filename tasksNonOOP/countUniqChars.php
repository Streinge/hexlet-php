<?php

namespace Hexlet\Php\CountUniqChars;

function countUniqChars(string $text): int
{
    if ($text === '') {
        return 0;
    }
    $chars = str_split($text);
    $unique = [];
    foreach ($chars as $char) {
        if (!in_array($char, $unique)) {
            $unique[] = $char;
        }
    }
    return count($unique);
}

$text1 = 'yyab';
echo countUniqChars($text1) . "\n"; // 3
 
$text2 = 'You know nothing Jon Snow';
echo countUniqChars($text2) . "\n"; // 13
 
$text3 = '0';
echo countUniqChars($text3) . "\n"; // 0
