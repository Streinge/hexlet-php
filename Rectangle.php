<?php

namespace Hexlet\Php;

// Эти функции были даны
function makeDecartPoint($x, $y)
{
    return [
        'x' => $x,
        'y' => $y
    ];
}

function getX($point)
{
    return $point['x'];
}

function getY($point)
{
    return $point['y'];
}

function getQuadrant($point)
{
    $x = getX($point);
    $y = getY($point);

    if ($x > 0 && $y > 0) {
        return 1;
    } elseif ($x < 0 && $y > 0) {
        return 2;
    } elseif ($x < 0 && $y < 0) {
        return 3;
    } elseif ($x > 0 && $y < 0) {
        return 4;
    }

    return null;
}

// Отсюда начинается решение

function makeRectangle($point, $width, $height)
{
    return ['start' => $point, 'width' => $width, 'height' => $height];
}

function getStartPoint(array $rectangle)
{
    return $rectangle['start'];
}

function getWidth(array $rectangle)
{
    return $rectangle['width'];
}

function getHeight(array $rectangle)
{
    return $rectangle['height'];
}

function containsOrigin(array $rectangle)
{
    $startPoint = getStartPoint($rectangle);

    if (getQuadrant($startPoint) !== 2) {
        return false;
    }

    $width = getWidth($rectangle);
    $height = getHeight($rectangle);

    $diagonalPoint = makeDecartPoint(getX($startPoint) + $width, getY($startPoint) - $height);

    if (getQuadrant($diagonalPoint) !== 4) {
        return false;
    } else {
        return true;
    }
}


$p = makeDecartPoint(0, 1);
$rectangle = makeRectangle($p, 4, 5);
containsOrigin($rectangle); // false

$rectangle2 = makeRectangle(makeDecartPoint(-4, 3), 5, 4);
containsOrigin($rectangle2); // true