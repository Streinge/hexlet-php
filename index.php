<?php

<<<<<<< Updated upstream
// BEGIN
function  isHappy(string $number): bool
{   
    $sumBegin = 0;
    $sumEnd = 0;
    for ($i = 0; $i <= (strlen($number) - 1) / 2; $i++) {
        echo $i . "\n";
        $sumBegin = $sumBegin + (int) $number[$i];
        $sumEnd = $sumEnd + (int) $number[- ($i + 1)];
    }

    return $sumBegin === $sumEnd;
}
var_dump(isHappy('00'));
=======
function joinNumbersFromRange($number1, $number2)
{
    // BEGIN (write your solution here)
    $i = $number1;
    $result = '';
    while ($i <= $number2) {
        $result = "{$result}{$i}";
        $i = $i + 1;
    }
    return $result;
    // END
}
// Вызов функции 
print_r(joinNumbersFromRange(4, 10));
>>>>>>> Stashed changes
