<?php

namespace App\Solution;

// BEGIN
function barChart(array $numbers): void
{
    $top = abs(max($numbers));
    $bottom = abs(min($numbers));
    $height = $top + $bottom;

    $lines = [];

    for ($i = $height; $i > 0; $i--) {
        $row = array_map(function ($number) use ($i, $bottom) {
            if ($i > $bottom) {
                return $number >= $i - $bottom ? '*' : ' ';
            }
            return $number < $i - $bottom ? '#' : ' ';
        }, $numbers);

        $lines[] = implode('', $row);
    }

    $emptyLine = str_repeat(' ', count($numbers));
    $chart =  array_filter($lines, fn($line) => $line !== $emptyLine);
    print_r(implode("\n", $chart));
}
// END

barChart([5, 10, 4, 6]);