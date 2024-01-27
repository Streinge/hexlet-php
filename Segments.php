<?php

namespace Hexlet\Php;

function makeDecartPoint(int $xDecart, int $yDecart): array
{
    return ['x' => $xDecart, 'y' => $yDecart];
}

function getX(array $point): int|float
{
    return $point['x'];
}

function getY(array $point): int|float
{
    return $point['y'];
}



function makeSegment(array $point1, array $point2)
{
    return ['begin' => $point1, 'end' => $point2];
}

function getBeginPoint(array $segment)
{
    return ['x' => getX($segment['begin']), 'y' => getY($segment['begin'])];
}

function getEndPoint(array $segment)
{
    return ['x' => getX($segment['end']), 'y' => getY($segment['end'])];
}

function getMidpointOfSegment(array $segment)
{
    $xMid = (getX(getBeginPoint($segment)) + getX(getEndPoint($segment))) / 2;
    $yMid = (getY(getBeginPoint($segment)) + getY(getEndPoint($segment))) / 2;
    return ['x' => $xMid, 'y' => $yMid];
}

$segment = makeSegment(makeDecartPoint(3, 2), makeDecartPoint(0, 0));
var_dump(getMidpointOfSegment($segment)); // (1.5, 1)
var_dump(getBeginPoint($segment)); // (3, 2)
var_dump(getEndPoint($segment)); // (0, 0)
