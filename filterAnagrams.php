<?php

namespace Hexlet\Php;

use function Functional\unique;

function comparesWords(string $word, string $testWord)
{
    if (strlen($word) !== strlen($testWord)) {
        return false;
    }
    $charsTestWord = array_unique(str_split($testWord));
    $isEqual = array_unique(array_map(function ($char) use ($word, $testWord) {
        return substr_count($word, $char) === substr_count($testWord, $char);
    }, $charsTestWord));
    [$first] = $isEqual;
    return count($isEqual) === 1 && $first;
}
function filterAnagrams(string $word, array $list)
{
    $result = array_filter($list, function ($testWord) use ($word) {
        return comparesWords($word, $testWord);
    });
    return array_values($result);
}

//var_dump(comparesWords('abba', 'dada'));
//var_dump(filterAnagrams('abba', ['aabb', 'abcd', 'bbaa', 'dada']));
// ['aabb', 'bbaa']
//var_dump(filterAnagrams('racer', ['crazer', 'carer', 'racar', 'caers', 'racer']));
// ['carer', 'racer']
var_dump(filterAnagrams('laser', ['lazing', 'lazy',  'lacer']));
// []
