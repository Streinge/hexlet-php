<?php

namespace Hexlet\Php\GetChunked;

function getChunked(array $incomig, $number): array
{
    if (empty($incomig)) {
        return [];
    }
    $chunkedArray = [];

    if (count($incomig) % $number === 0) {
        $numberСhunks = count($incomig) / $number;
    } else {
        $numberСhunks = floor(count($incomig) / $number) + 1;
    }
    for ($i = 1; $i <= $numberСhunks; $i++) {
        $slice = array_slice($incomig, ($i - 1) * $number, $number);
        $chunkedArray[] = $slice;
    }
    return $chunkedArray;
}

// var_dump(getChunked([], 4));
// → [['a', 'b'], ['c', 'd']]

var_dump((getChunked(['a', 'b', 'c', 'd'], 2)) === [['a', 'b'], ['c', 'd']]);
// → [['a', 'b', 'c'], ['d']]
