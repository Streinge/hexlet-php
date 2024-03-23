<?php

namespace Hexlet\Php;

<?php

namespace App\Comparator;

// BEGIN (write your solution here)
use DS\Stack;

function returnedStrWithoutBcS(string $seq)
{
    $stack = new Stack();
    for ($i = 0; $i < strlen($seq); $i++) {
        if ($seq[$i] !== '#') {
            $stack->Stack::push($seq[$i]);
        } else {
            if (!($stack->Stack::isEmpty())) {
                $stack->Stack::pop();
            }
        }
    }
    $result = '';
    while (!($stack->Stack::isEmpty())) {
        $result .= $stack->Stack::pop();
    }
    return $result;
}

function compare($seq1, $seq2)
{
    $str1 = returnedStrWithoutBcS($seq1);
    $str2 =  returnedStrWithoutBcS($seq2);
    return $str1 === $str2;
}
// END
