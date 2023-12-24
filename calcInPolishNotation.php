<?php

namespace Hexlet\Php\CalcInPolishNotation;

function calcInPolishNotation(array $list): int
{
    $operators = ['+', '-', '*', '/'];
    $length = count($list);
    $stack = [];
    foreach ($i = 0; $i < $length; $i++) {
        if (in_array($list[$i], $operators)) {
            $operand2 = array_pop($stack);
            $operand1 = array_pop($stack);
        }
    }

}