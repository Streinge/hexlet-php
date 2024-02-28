<?php

namespace Hexlet\Php;

class Time
{
    private $h;
    private $m;

    // BEGIN (write your solution here)
    public static function fromString(string $time)
    {
        [$hour, $min] = explode(':', $time);
        return new Time($hour, $min);
    }
    // END

    public function __construct($h, $m)
    {
        $this->h = $h;
        $this->m = $m;
    }

    public function __toString()
    {
        return "{$this->h}:{$this->m}";
    }
}

$time = new Time(10, 15);
echo $time; // => 10:15

$time = Time::fromString('10:23');
var_dump('10:23' == $time); // автоматически вызывается __toString
