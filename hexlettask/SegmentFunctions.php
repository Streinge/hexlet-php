<?php

namespace Hexlet\Code;

require_once 'Segment.php';
require_once 'Point.php';

use Hexlet\Php\Segment;
use Hexlet\Php\point;

function reverse(Segment $segment)
{
    $newBegin = new Point($segment->endPoint->x, $segment->endPoint->y);
    $newEnd = new Point($segment->beginPoint->x, $segment->beginPoint->y);
    return new Segment($newBegin, $newEnd);
}

$segment = new Segment(new Point(1, 10), new Point(11, -3));

$reversedSegment = reverse($segment);

print_r($reversedSegment->beginPoint); // (11, -3)
print_r($reversedSegment->endPoint); // (1, 10)

$point1 = new Point(1, 10);
$point2 = new Point(11, -3);
$segment = new Segment($point1, $point2);
$reversedSegment = reverse($segment);

var_dump($point2 == $reversedSegment->beginPoint);//assertEquals
var_dump($point2 === $reversedSegment->beginPoint);//assertNotSame

//$this->assertEquals($point1, $reversedSegment->endPoint);
//$this->assertNotSame($point1, $reversedSegment->endPoint);
