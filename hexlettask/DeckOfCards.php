<?php

namespace Hexlet\Php;

use Tightenco\Collect\Support\Collection;

class DeckOfCards
{
    public $cards;

    public function __constuct($cards)
    {
        var_dump($cards);
        $this->cards = collect($cards);
        var_dump($this->cards);
    }

    public function getShuffled()
    {
        $flattened = $this->cards->flatten();
        return $flattened->shuffle();
    }
}
$deck = new DeckOfCards([2, 3]);
var_dump($deck);
//$deck->getShuffled(); // [2, 3, 3, 3, 2, 3, 2, 2]
//$deck->getShuffled(); // [3, 3, 2, 2, 2, 3, 3, 2]
//$b = collect([2, 3]);
//var_dump($b);
$collection1 = new Collection();
//$collection = collect(['name' => 'taylor', 'languages' => ['php', 'javascript']]);
var_dump($collection1);
