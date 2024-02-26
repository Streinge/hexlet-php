<?php

namespace Hexlet\Php;

function calculateDistance(array $point1, array $point2): int|float|null
{
    [$x1, $y1] = $point1;
    [$x2, $y2] = $point2;
    return sqrt(($x2 - $x1) ** 2 + ($y2 - $y1) ** 2);
}

$point1 = [0, 0];
$point2 = [3, 4];
echo calculateDistance($point1, $point2); // 5
