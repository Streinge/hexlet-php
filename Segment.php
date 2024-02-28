<?php

namespace Hexlet\Php;

require_once 'Point.php';

use Hexlet\Php\Point;

class Segment
{
    private $beginPoint;
    private $endPoint;

    public function __construct(Point $beginPoint, Point $endPoint)
    {
        $this->beginPoint = $beginPoint;
        $this->endPoint = $endPoint;
    }

    public function __toString()
    {
        return "[{$this->beginPoint}, {$this->endPoint}]";
    }
}

$point1 = new Point(1, 10);
$point2 = new Point(11, -3);
$segment1 = new Segment($point1, $point2);
echo $segment1 . "\n"; // [(1, 10), (11, -3)]

$segment2 = new Segment($point2, $point1);
echo $segment2 . "\n"; // [(11, -3), (1, 10)]
