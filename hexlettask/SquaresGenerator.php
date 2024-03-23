<?php

namespace Hexlet\Php;

require_once 'Square.php';

use Hexlet\Php\Square;

class SquaresGenerator
{
    public $side;
    public $numbers;

    public static function generate($side, $numbers = 5)
    {
        $array = [];
        for ($i = 1; $i <= $numbers; $i++) {
            $array[] = new Square($side);
        }
        return $array;
    }
}

$square = new Square(10);
print_r($square->getSide()); // 10

$squares = SquaresGenerator::generate(3, 2);
// [new Square(3), new Square(3)];
print_r($squares);
