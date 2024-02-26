<?php

namespace Hexlet\Php\isPowerOfThree;

function isPowerOfThree(int $number): bool
{
    for ($i = 0; $i <= pow($number, 1 /3); $i++) {
        if (pow(3, $i) === $number) {
            return true;
        }
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
