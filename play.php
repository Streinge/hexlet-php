<?php

namespace Hexlet\Php;

$rollDie = function () {
    return rand(1, 6);
};

function play(int $number, $rollDie): void
{
    $initialArray = range(0, $number - 1);
    $randArray = array_map($rollDie, $initialArray);
    $numberDrops = array_reduce($randArray, function ($acc, $drop) {
        $acc[$drop] += 1;
        return $acc;
    }, array_fill(1, 6, 0));
    $histogram = array_reduce(array_keys($numberDrops), function ($acc, $key) use ($numberDrops) {
        $chars = str_repeat("#", $numberDrops[$key]);
        $lastValue = $numberDrops[$key];
        $acc[] = ($numberDrops[$key] !== 0) ? "{$key}|{$chars} {$lastValue}" : "{$key}|";
        return $acc;
    }, []);
    print_r(implode("\n", $histogram));
}

play(500, $rollDie);
