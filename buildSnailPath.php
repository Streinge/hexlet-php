<?php

namespace Hexlet\Php\buildSnailPath;

function rotatedMatrix(array $matrix): array
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
function buildSnailPath(array $matrix): array
{
    $result = [];
    $newMatrix = $matrix;
    while (!empty($newMatrix)) {
        [$firstRow] = $newMatrix;
        $result = [...$result, ...$firstRow];
        unset($newMatrix[0]);
        rotatedMatrix($newMatrix);
    }
    return $result;
}

print_r(buildSnailPath([
    [1, 2],
    [3, 4],
  ])); // [1, 2, 4, 3]