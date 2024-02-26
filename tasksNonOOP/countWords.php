<?php

namespace Hexlet\Php;

function countWords(string $sentence): array
{
    if (empty($sentence)) {
        return [];
    }
    $copySentence = $sentence;
    $copySentence = mb_strtolower($copySentence);
    $words = explode(' ', $copySentence);
    $count = [];
    foreach ($words as $word) {
        $count[$word] = ($count[$word] ?? 0) + 1;
    }
    return $count;
}

$text1 = 'one two three two ONE one wow';
var_dump(countWords($text1));

$text2 = 'another one sentence with strange Words words';
var_dump(countWords($text2));
