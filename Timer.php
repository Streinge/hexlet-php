<?php

namespace Hexlet\Php;

class Timer
{
    public const SEC_PER_MIN = 60;
    
    public const SEC_PER_HOUR = 3600;

    public $seconds;
    public $minutes;
    public $hours;
    public $secondsCount;

    public function __construct($seconds, $minutes = 0, $hours = 0)
    {
        $this->$seconds = $seconds;
        $this->minutes = $minutes;
        $this->hours = $hours;
        $this->secondsCount = $seconds + $minutes * Timer::SEC_PER_MIN + $hours * Timer::SEC_PER_HOUR;
    }
    public function getLeftSeconds()
    {
        return $this->secondsCount;
    }

    public function tick()
    {
        $this->secondsCount--;
    }
}

$timer1 = new Timer(10);
var_dump($timer1->getLeftSeconds()); // 10
$timer1->tick();
var_dump($timer1->getLeftSeconds()); // 9

$timer2 = new Timer(8, 20, 8);
var_dump($timer2->getLeftSeconds()); // 30008
