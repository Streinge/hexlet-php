<?php

namespace Hexlet\Php\CalculateAverage;

function  calculateAverage(array $items): float
{
    // empty() проверяет является ли переменная пустой
    if (empty($items)) {
        return 0;
    }
    $sum = 0;
    foreach ($items as $item) {
        $sum = $sum + $item;
    }
    return $sum / count($items);
}

$temperatures = [37.5, 34, 39.3, 40, 38.7, 41.5];
 
echo calculateAverage($temperatures). "\n"; // 38.5
$temperatures = [];
 
echo calculateAverage($temperatures); // 38.5