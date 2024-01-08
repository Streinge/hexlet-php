<?php

namespace Hexlet\Php;

function filterAnagrams(string $word, array $list)
{
    $arrWord = str_split($word);
    $numberChar = array_reduce($arrWord, function ($acc, $word) {
        $acc[$word] = ($acc[$word] ?? 0) + 1;
        return $acc;
    }, []);
    //$result = array_filter($list, function ($testWord) use ($arrWord))

    //$result = array
    return $numberChar;
}

var_dump(filterAnagrams('abba', ['aabb', 'abcd', 'bbaa', 'dada']));
// ['aabb', 'bbaa']
