<?php

namespace Hexlet\Php;

function getMidpoint(array $point1, array $point2): array
{
    $x = ($point1['x'] + $point2['x']) / 2;
    $y = ($point1['y'] + $point2['y']) / 2;
    return  ['x' => $x, 'y' => $y];
}
