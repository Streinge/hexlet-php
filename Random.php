<?php

namespace Hexlet\Php;

class Random
{
    private $randMax;
    private $next;

    public function __construct($randMax, $next = 1)
    {
        $this->randMax = $randMax;
        $this->next = $next;
    }

    public function getNext()
    {
        $this->next = $this->next * 1103515245 + 12345;
        return (int) ($this->next / 65536) % ($this->randMax + 1);
    }

    public function reset()
    {
        $this->next = 1;
    }
}

$seq = new Random(100);
$result1 = $seq->getNext();
$result2 = $seq->getNext();

var_dump($result1 !== $result2); // true

$seq->reset();
$result21 = $seq->getNext();
$result22 = $seq->getNext();

var_dump($result1 === $result21); // true
var_dump($result2 === $result22); // true
