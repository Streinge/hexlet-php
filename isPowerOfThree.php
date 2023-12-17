<?php

namespace Hexlet\Php\isPowerOfThree;

function isPowerOfThree(int $number): bool
{
   $degree = round(pow($number, 1 / 3));
   var_dump(pow($number, 1 / 3));
   var_dump((3 ** $degree));
   if ((int) (3 ** $degree) === $number) {
       return true;
   } else return false;
}

var_dump(isPowerOfThree(10460353203));