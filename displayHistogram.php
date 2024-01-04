<?php

namespace Hexlet\Php;

$rollDie = function () {
    return rand(1, 6);
};

function displayHistogram(int $number, $rollDie)
{
    $initialArray = range(0, $number - 1);
    $randArray = array_map($rollDie, $initialArray);
    $numberDrops = array_reduce($randArray, function ($acc, $drop) {
        $acc[$drop] += 1;
        return $acc;
    }, array_fill(1, 6, 0));
    $percentDrops = array_map(fn($drop) => round($drop * 100 / $number), $numberDrops);


    return $percentDrops;
}

var_dump(displayHistogram(30, $rollDie));
