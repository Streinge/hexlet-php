<?php

namespace Hexlet\Php;

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

use Ds\Deque;

class Drunkard
{
    public $list;

    public function run($list1, $list2)
    {
        $decue1 = new Deque($list1);
        $decue2 = new Deque($list2);
        $count = 0;

        while (!empty($decue1->toArray()) && !empty($decue2->toArray()) && $count < 100) {
            $card1 = $decue1->pop();
            $card2 = $decue2->pop();

            if ($card1 > $card2) {
                $decue1->insert(0, $card1);
                $decue1->insert(0, $card2);
            } elseif ($card2 > $card1) {
                $decue2->insert(0, $card2);
                $decue2->insert(0, $card1);
            }
            $count++;
        }

        if ($count >= 100) {
            return "Botva!";
        }

        if (empty($decue2->toArray())) {
            return (!empty($decue1->toArray())) ? "First player. Round: {$count}" : "Botva!";
        } elseif (empty($decue1->toArray())) {
            return "Second player. Round: {$count}";
        }
    }
}

$game = new Drunkard();
$result = $game->run([1], [2]);
echo "Должно быть TRUE\n";
var_dump('Second player. Round: 1' == $result);
echo "Должно быть TRUE\n";
$result = $game->run([2], [1]);
var_dump('First player. Round: 1' == $result);
echo "Должно быть TRUE\n";
$result = $game->run([1], [1]);
var_dump('Botva!' == $result);
echo "Должно быть TRUE\n";
$result = $game->run([1, 2], [3, 2]);
var_dump('Second player. Round: 2' == $result);
echo "Должно быть TRUE\n";
$result = $game->run([1, 3], [2, 1]);
var_dump('First player. Round: 4' == $result);
echo "Должно быть TRUE\n";
$result = $game->run(array_fill(0, 100, 1), array_fill(0, 100, 1));
var_dump('Botva!' == $result);
