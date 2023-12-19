<?php

namespace Hexlet\Php\CheckIfBalanced;

function checkIfBalanced(string $expression): bool
{
    $size = strlen($expression);
    $stack = [];
    for ($i = 0; $i < $size; $i++) {
        if ($expression[$i] === '(') {
            array_push($stack, '(');
        } elseif ($expression[$i] === ')') {
            array_pop($stack);
        }
        print_r($stack);
    }
    if (empty($stack)) {
        return true;
    } else return false;
}

var_dump(checkIfBalanced('(5 + 6) * (7 + 8)/(4 + 3)')); // true
var_dump(checkIfBalanced('(4 + 3))')); // false
