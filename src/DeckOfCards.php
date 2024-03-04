<?php

namespace Hexlet\Php;

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

use Tightenco\Collect\Support\Collection;

class DeckOfCards
{
    public $cards;

    public function __construct($cards)
    {
        $deck = array_merge(...array_fill(0, 4, $cards));
        $this->cards = collect($deck);
    }

    public function getShuffled()
    {
        return $this->cards->flatten()
            ->shuffle()
            ->all();
    }
}


$expected = [2, 2, 2, 2, 3, 3, 3, 3];
$deck = new DeckOfCards([2, 3]);
$result1 = $deck->getShuffled();
$result2 = $deck->getShuffled();
var_dump($result1 == $result2); // false

sort($result1);
var_dump($expected === $result1); // true

sort($result2);
var_dump($expected === $result2); // true

$expected = [7, 7, 7, 7, 8, 8, 8, 8, 9, 9, 9, 9];
$deck = new DeckOfCards([8, 9, 7]);
$result1 = $deck->getShuffled();
$result2 = $deck->getShuffled();
var_dump($result1 === $result2);  // false

sort($result1);
var_dump($expected === $result1); // true

sort($result2);
var_dump($expected === $result2); // true
