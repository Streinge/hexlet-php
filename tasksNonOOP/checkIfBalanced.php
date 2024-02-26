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
            $status = array_pop($stack);
        }
    }
    if (!empty($stack) || $status === null) {
        return false;
    }
    return true;
}

var_dump(checkIfBalanced('(5 + 6) * (7 + 8)/(4 + 3)')); // true
var_dump(checkIfBalanced('(4 + 3))')); // false
var_dump(checkIfBalanced('(')); // false
var_dump(checkIfBalanced(')')); // false
var_dump(checkIfBalanced(')()(')); // false
var_dump(checkIfBalanced('3+5)()('));
var_dump(checkIfBalanced('(()'));
var_dump(checkIfBalanced('(1-(7+(3+5)*(2-1))'));
