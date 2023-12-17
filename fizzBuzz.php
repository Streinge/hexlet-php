<?php

// BEGIN
function  fizzBuzz(int $begin, int $end): void
{   
    $result = '';
    for ($i = $begin; $i <= $end; $i++) {
        if ($i % 3 === 0 && $i % 5 === 0) {
            $result = "{$result} FizzBuzz";
        } elseif ($i % 3 === 0) {
            $result = "{$result} Fizz";
        } elseif ($i % 5 === 0) {
            $result = "{$result} Buzz";
        } else {
            $result = "{$result} {$i}";
        }
    }
    print_r(trim($result));
}
var_dump(fizzBuzz(11, 20));