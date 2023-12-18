<?php

namespace Hexlet\Php\GetSuperSeriesWinner;

function getSuperSeriesWinner(array $score): string
{
    $sum = 0;
    foreach ($score as $item) {
        $sum += $item[0] <=> $item[1];
    }
    if ($sum > 0) {
        return 'canada';
    } elseif ($sum < 0) {
        return 'ussr';
    } else {
        return null;
    }
}
$scores = [
    [3, 7], // Первая игра
    [4, 1], // Вторая игра
    [4, 4],
    [3, 5],
    [4, 5],
    [3, 2],
    [4, 3],
    [6, 5],
  ];
   
  print_r(getSuperSeriesWinner($scores)); // 'canada'
  