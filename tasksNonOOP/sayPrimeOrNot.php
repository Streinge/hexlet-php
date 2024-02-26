<?php

namespace Hexlet\Php;

function isPrime(int $number): bool
{
    if ($number < 2) {
        return false;
    }
    for ($i = 2; $i < $number; $i++) {
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}

function sayPrimeOrNot(int $number): void
{
    if (isPrime($number)) {
        print_r('yes');
    } else {
        print('no');
    }
}
