<?php

namespace Hexlet\Php\RotateLeft;

function rotateLeft(array $matrix): array
{
    if (empty($matrix)) {
        return $matrix;
        }
        $m = count($matrix);
        [$firstRow] = $matrix;
        $n = count($firstRow);
        $result = [];
        for ($j = 0; $j < $n; $j++) {
            for ($i = 0; $i < $m; $i++) {
                $result[$j][$i] = $matrix[$i][$n - $j - 1]; 
            } 
        }
        return $result;
}

function rotateRight(array $matrix): array
{
    if (empty($matrix)) {
        return $matrix;
        }
        $m = count($matrix);
        [$firstRow] = $matrix;
        $n = count($firstRow);
        $result = [];
        for ($j = 0; $j < $n; $j++) {
            for ($i = 0; $i < $m; $i++) {
                $result[$j][$i] = $matrix[$m - $i - 1][$j];
            } 
        }
        return $result;
}

$matrix = [
    [1, 2, 3, 4],
    [5, 6, 7, 8],
    [9, 0, 1, 2],
  ];

$new = rotateRight($matrix);

foreach ($new as $b) echo json_encode($b),"\n";