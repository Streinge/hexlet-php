<?php

namespace Hexlet\Php\CalcInPolishNotation;

function calcInPolishNotation(array $list)
{
    $operators = ['+', '-', '*', '/'];
    $length = count($list);
    $stack = [];
    for ($i = 0; $i < $length; $i++) {
        if (in_array($list[$i], $operators)) {
            $operand2 = array_pop($stack);
            $operand1 = array_pop($stack);
            switch ($list[$i]) {
                case '+' : $result = $operand1 + $operand2;
                    break;
                case '-' : $result = $operand1 - $operand2;
                    break;
                case '*' : $result = $operand1 * $operand2;
                    break;
                case '/' : if ($operand2 === 0) return null;
                           $result = $operand1 / $operand2;
            }
        array_push($stack, $result);
        } else {
            array_push($stack, $list[$i]);
        }

    }
    return $stack[0];
}