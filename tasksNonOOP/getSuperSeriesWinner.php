<?php

namespace Hexlet\Php\GetSuperSeriesWinner;

function getSuperSeriesWinner(array $score)
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
    [3, 2],
    [4, 1],
    [5, 8],
    [5, 5],
    [2, 2],
    [2, 4],
    [4, 2],
    [2, 3],
];
   
  print_r(getSuperSeriesWinner($scores)); // 'canada'
  