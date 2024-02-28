<?php

//require_once __DIR__ . '/vendor/autoload.php';

namespace Hexlet\Php;

class Point
{
    public $x;
    public $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
}

function getMidpoint(Point $point1, Point $point2): Point
{
    $midPpint = new Point();
    $midPpint->x = ($point1->x + $point2->x) / 2;
    $midPpint->y = ($point1->y + $point2->y) / 2;
    return $midPpint;
}
/*$point1 = new Point();
$point1->x = 1;
$point1->y = 10;
$point2 = new Point();
$point2->x = 10;
$point2->y = 1;

$midpoint = getMidpoint($point1, $point2);
var_dump($midpoint->x); // 5.5
var_dump($midpoint->y); // 5.5*/
