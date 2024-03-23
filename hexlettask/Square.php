<?php

namespace Hexlet\Php;

class Square
{
    private $side;

    public function __construct(int $side)
    {
        $this->side = $side;
    }

    public function getSide()
    {
        return $this->side;
    }
}

