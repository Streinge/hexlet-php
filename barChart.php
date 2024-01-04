<?php

namespace Hexlet\Php;

function barChart(array $sequence)
{
    $maxValue = (max($sequence) > 0) ? max($sequence) : -1;
    $minValue = (min($sequence) > 0) ? 1 : min($sequence);
    for ($i = $maxValue; $i >= $minValue; $i--) {
        $result = '';
        foreach ($sequence as $number) {
            if ($number >= $i && $i > 0) {
                $result .= "*";
            } elseif ($number <= $i && $i < 0) {
                $result .= "#";
            } else {
                $result .= " ";
            }
        }
        if ($i !== 0) {
            if ($i === $maxValue) {
                echo $result;
            } else {
                echo "\n" . $result;
            }
        }
    }
}

barChart([5, 10, 4, 6]);
