<?php

//require_once __DIR__ . '/vendor/autoload.php';

namespace Hexlet\Php;

class Point
{
    private $x;
    private $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
    public function __toString()
    {
        return "({$this->x}, {$this->y})";
    }
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
