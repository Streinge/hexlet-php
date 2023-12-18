<?php

namespace Hexlet\Php\isContinuousSequence;

function isContinuousSequence(array $numbers): bool
{
    if ($numbers === [] || count($numbers) === 1) {
        return false;
    }
    for ($i = $numbers[0], $lenght = count($numbers); $i <= $lenght - 1; $i++) {
        if ($numbers[$i + 1] - $numbers[$i] !== 1) {
            return false;
        }
    }
    return true;
}
    


var_dump(isContinuousSequence([10, 11, 12, 13]));     // true
var_dump(isContinuousSequence([10, 11, 12, 14, 15])); // false
var_dump(isContinuousSequence([1, 2, 2, 3]));         // false
var_dump(isContinuousSequence([]));                   // false
