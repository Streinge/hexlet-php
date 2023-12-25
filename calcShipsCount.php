<?php

namespace Hexlet\Php\CalcShipsCount;

function calcShipsCount(array $map)
{
    [$firstRow] = $map;
    $xMax = count($firstRow) - 1;
    $yMax = count($map) - 1;
    $countShips = 0;
    $status = false;
    for($y = 0; $y <= $yMax; $y++) {
        for ($x = 0; $x <= $xMax; $x++) {
            if (!empty($map[$y][$x])) {
                if (empty($map[$y + 1][$x]) && empty($map[$y - 1][$x])) {
                    $status = true;
                }
            } else {
                if ($status) $countShips += 1;
                $status = false;

            }
        }
        if ($status) $countShips += 1;
        $status = false;
    }

    $m = count($map);
    [$firstRow] = $map;
    $n = count($firstRow);
    $rotatedMap = [];
    for ($j = 0; $j < $n; $j++) {
        for ($i = 0; $i < $m; $i++) {
            $rotatedMap[$j][$i] = $map[$i][$n - $j - 1]; 
        } 
    }

    [$firstRow] = $rotatedMap;
    $xMax = count($firstRow) - 1;
    $yMax = count($rotatedMap) - 1;
    $status = false;
    for($y = 0; $y <= $yMax; $y++) {
        for ($x = 0; $x <= $xMax; $x++) {
            if (!empty($rotatedMap[$y][$x])) {
                if (empty($rotatedMap[$y + 1][$x]) && empty($rotatedMap[$y - 1][$x])) {
                    $status = true;
                }
            } else {
                if ($status) $countShips += 1;
                $status = false;

            }
        }
        if ($status) $countShips += 1;
        $status = false;
    }

    return $countShips;
}

$map = ([
    [0, 1, 0, 0, 0, 0],
    [0, 1, 0, 1, 1, 1],
    [0, 0, 0, 0, 0, 0],
    [0, 1, 1, 1, 0, 1],
    [0, 0, 0, 0, 0, 1],
    [1, 1, 0, 1, 0, 0],
]);

echo calcShipsCount($map) . "\n";