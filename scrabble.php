<?php

namespace Hexlet\Php;

function scrabble(string $set, string $word)
{
    $newSet = strtolower($set);
    $newWord = strtolower($word);
    $setArray = [];
    for ($i = 0, $length = strlen($newSet); $i < $length; $i++) {
        if (array_key_exists($newSet[$i], $setArray)) {
            $setArray[$newSet[$i]] += 1;
        } else {
            $setArray[$newSet[$i]] = 1;
        }
    }
    $charArray = str_split($word);
    foreach ($charArray as $char) {
        (if )
    }

    return $setArray;
}

var_dump(scrabble('kakdsjhgfk', 'hdkas'));