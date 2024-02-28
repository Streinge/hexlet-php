<?php

namespace Hexlet\Php;

require_once 'point.php';

use Hexlet\Php\Point;

function dup(Point $point)
{
    $point2 = new Point();
    $point2->x = $point->x;
    $point2->y = $point->y;
    return $point2;
}

$point1 = new Point();
$point2 = dup($point1);

var_dump($point1 == $point2); // true
var_dump($point1 === $point2); // false

$point1 = new Point();
$point1->x = 3;
$point1->y = 5;
$point2 = dup($point1);

var_dump(3 === $point2->x); // true
var_dump(5 === $point2->y); // true
var_dump($point1 == $point2); // true
var_dump($point1 === $point2); // false
