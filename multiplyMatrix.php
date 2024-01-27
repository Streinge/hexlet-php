<?php

namespace Hexlet\Php\MultiplyMatrix;

function multiply(array $matrixA, array $matrixB): array
{
    $matrixC = [];
    $sizeM = count($matrixA);
    [$firstRowB] = $matrixB;
    $sizeK = count($firstRowB);
    [$firstRowA] = $matrixA;
    $sizeN = count($firstRowA);
    $currentValue = 0;
    for ($i = 0; $i < $sizeM; $i++) {
        for ($j = 0; $j < $sizeK; $j++) {
            for ($k = 0; $k < $sizeN; $k++) {
                $currentValue += $matrixA[$i][$k] * $matrixB[$k][$j];
            }
            $matrixC[$i][$j] = $currentValue;
            $currentValue = 0;
        }
    }
    return $matrixC;
}

$matrixA = [
    [2, 5],
    [6, 7],
    [1, 8],
  ];
$matrixB = [
    [1, 2, 1],
    [0, 1, 0],
  ];
foreach ($matrixA as $b) echo json_encode($b),"\n";
echo "\n";
foreach ($matrixB as $b) echo json_encode($b),"\n";
echo "\n";
$matrixC = multiply($matrixA, $matrixB);
foreach ($matrixC as $b) echo json_encode($b),"\n";
$matrixA = [[1, 2], [3, 2]];
$matrixB = [[3, 2], [1, 1]];
$matrixC = multiply($matrixA, $matrixB);
foreach ($matrixC as $b) echo json_encode($b),"\n";
$matrixA = [
    [3, 2],
    [1, 1],
  ];

  $matrixB = [
    [1, 2],
    [3, 2],
  ];
$matrixC = multiply($matrixA, $matrixB);
foreach ($matrixC as $b) echo json_encode($b),"\n";

$matrixA = [
    [1, 2, 1],
    [0, 1, 0],
    [2, 3, 4],
  ];

  $matrixB = [
    [2, 5],
    [6, 7],
    [1, 8],
  ];
$matrixC = multiply($matrixA, $matrixB);
foreach ($matrixC as $b) echo json_encode($b),"\n";

$matrixA = [
    [2, 5],
    [6, 7],
    [1, 8]
  ];

  $matrixB = [
    [1, 2, 1],
    [0, 1, 0],
  ];
  $matrixC = multiply($matrixA, $matrixB);
  foreach ($matrixC as $b) echo json_encode($b),"\n";

  $matrixA = [
    [1],
    [2]
  ];

  $matrixB = [[10, 20]];
  $matrixC = multiply($matrixA, $matrixB);
  foreach ($matrixC as $b) echo json_encode($b),"\n";