<?php

namespace Hexlet\Php\MultiplyMatrix;

function multiply(array $matrixA, array $matrixB): array
{
    $matrixC = [];
    $sizeM = count($matrixA);
    [$firstRowB] = $matrixB;
    $sizeK = count($firstRowB);
    $currentValue = 0;
    for ($i = 0; $i < $sizeM; $i++) {
        for ($j = 0; $j < $sizeK; $j++) {
            for ($k = 0; $k < $sizeK; $j++) {
                $currentValue += $matrixA[$i][$k] * $matrixB[$k][$i];
            }
            $matrixC[$i][$j] = $currentValue;
            $currentValue = 0;
        }

    }
    return $matrixC;
}

$matrixA = [[1, 2], [3, 2]];
$matrixB = [[3, 2], [1, 1]];
foreach ($matrixA as $b) echo json_encode($b),"\n";
echo "\n";
foreach ($matrixB as $b) echo json_encode($b),"\n";
