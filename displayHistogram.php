<?php

namespace Hexlet\Php;

$rollDie = function () {
    return rand(1, 6);
};

function displayHistogram(int $number, $rollDie): void
{
    $initialArray = range(0, $number - 1);
    $randArray = array_map($rollDie, $initialArray);
    $numberDrops = array_reduce($randArray, function ($acc, $drop) {
        $acc[$drop] += 1;
        return $acc;
    }, array_fill(1, 6, 0));
    $top = abs(max($numberDrops));
    $lines = [];
    for ($i = $top; $i >= 0; $i--) {
        $row = array_map(function ($quantity) use ($i, $number) {
            if ($quantity === $i) {
                if ($quantity !== 0) {
                    $percent = str_pad((string) (round($quantity * 100 / $number)), 2, " ", STR_PAD_LEFT);
                    return "{$percent}%";
                } else {
                    return "   ";
                }
            } else {
                return $quantity > $i ? '###' : '   ';
            }
        }, $numberDrops);

        $lines[] = implode(' ', $row);
    }
    $hyphensLine = str_repeat('-', strlen($lines[0]));
    $lines[] = $hyphensLine;
    $keys = range(1, 6);
    $rowEnd = array_reduce($keys, function ($acc, $key) {
        $acc[] = " {$key} ";
        return $acc;
    }, []);
    $lines[] = implode(' ', $rowEnd);
    $emptyLine = str_repeat(' ', strlen($lines[0]));
    $histogram =  array_filter($lines, fn($line) => $line !== $emptyLine);
    print_r(implode("\n", $histogram));
}


displayHistogram(5, $rollDie);
