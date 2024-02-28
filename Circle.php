<?php

namespace Hexlet\Php;

class Circle
{
    private $radius;

    public function __construct($rad)
    {
        $this->radius = $rad;
    }

    public function getArea()
    {
        return ($this->radius ** 2) * pi();
    }

    public function getCircumference()
    {
        return $this->radius * 2 * pi();
    }
}

$circle = new Circle(10);

print_r($circle);

print_r($circle->getArea());

echo "\n";

print_r($circle->getCircumference());