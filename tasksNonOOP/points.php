<?php

namespace Hexlet\Php;

function makePoint($x, $y)
{
     return [
         'angle' => atan2($y, $x),
         'radius' => sqrt($x ** 2 + $y ** 2)
     ];
}

function getX(array $point)
{
    return $point['radius'] * cos($point['angle']);
}


function getY(array $point)
{
    return $point['radius'] * sin($point['angle']);
}
$x = 4;
$y = 8;

$point = makePoint($x, $y);

var_dump(getX($point));
var_dump(getY($point));

//Получить x можно по формуле radius * cos(angle)
//Получить y можно по формуле radius * sin(angle)