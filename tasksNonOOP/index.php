<?php
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
