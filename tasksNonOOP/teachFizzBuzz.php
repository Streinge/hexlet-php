<?php

namespace App\Solution;

// BEGIN
function fizzBuzz($begin, $end)
{
    for ($i = $begin; $i <= $end; $i++) {
        $hasFizz = $i % 3 === 0;
        $hasBuzz = $i % 5 === 0;
        $fizzPart = $hasFizz ? 'Fizz' : '';
        $buzzPart = $hasBuzz ? 'Buzz' : '';
        print_r($hasFizz || $hasBuzz ? "{$fizzPart}{$buzzPart}" : $i);
        print_r(" ");
    }
}
// END