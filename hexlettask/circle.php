<?php

namespace Hexlet\Php;

require_once 'Point.php';

use Hexlet\Php\Point;

class Circle
{
    public $center;
    public $radius;
}

$circle = new Circle();

$circle->radius = 3;
$circle->center = new Point();

$circle->center->x = 5;
$circle->center->y = 10;


var_dump($circle->radius);

var_dump($circle->center->x);
