<?php

namespace Hexlet\Php\Fib;

function fib(int $sequenceNumber): int
{
    if ($sequenceNumber === 0) {
        return 0;
    }
    if ($sequenceNumber === 1) {
        return 1;
    }
    return fib($sequenceNumber-1) + fib($sequenceNumber-2);
}

echo fib(25);
