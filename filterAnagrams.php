<?php

namespace Hexlet\Php;

/*function counter(string $word): array
{
    $arrWord = str_split($word);
    $countChar = array_reduce($arrWord, function ($acc, $word) { 
        $acc[$word] = ($acc[$word] ?? 0) + 1;
        return $acc;
    }, []);
    return $countChar;
}

function filterAnagrams(string $word, array $list)
{
    $countWord = counter($word);
    $result = array_filter($list, function ($testWord) use ($countWord) {
        var_dump($testWord);
        $counterTest = counter($testWord);
        return $counterTest === $countWord;
    });

    return $result;
}*/
function filterAnagrams(string $word, array $list)
{
    array_filter($list, function ($testWord) use ($word) {
        $arrayWord = array_values(array_unique(str_split($testWord)));
        return array_map(function ($char) use ($testWord, $word) {
            return (substr_count($char, $testWord) === substr_count($char, $word));
        }, $arrayWord);
    });

}

var_dump(filterAnagrams('abba', ['aabb', 'abcd', 'bbaa', 'dada']));
// ['aabb', 'bbaa']
