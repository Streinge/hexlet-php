<?php

namespace Hexlet\Php\isPowerOfThree;

function isPowerOfThree(int $num)
// В отличие от моего решения для каждого числа степень
// по новой не вычисляестя поэтому работает быстрее
{
    $current = 1;
    while ($current <= $num) {
        if ($current === $num) {
            return true;
        }
        $current *= 3;
    }

    return false;
}

$start = microtime(true);
var_dump(assert(false === isPowerOfThree(0)));
var_dump(assert(true === isPowerOfThree(1)));
var_dump(assert(true === isPowerOfThree(3)));
var_dump(assert(false === isPowerOfThree(5)));
var_dump(assert(false === isPowerOfThree(6)));
var_dump(assert(true === isPowerOfThree(9)));
var_dump(assert(true === isPowerOfThree(27)));
var_dump(assert(true === isPowerOfThree(81)));
var_dump(assert(true === isPowerOfThree(59049)));
var_dump(assert(true === isPowerOfThree(3486784401)));
var_dump(assert(true === isPowerOfThree(3486784401)));
var_dump(assert(true === isPowerOfThree(10460353203)));
var_dump(assert(true === isPowerOfThree(94143178827)));
var_dump(assert(false === isPowerOfThree(999999)));
var_dump(assert(false === isPowerOfThree(1234567890)));
$end = microtime(true);
$time = $end - $start;

echo "Did nothing in $time seconds\n";
