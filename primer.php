<?php

function rotatedMatrix(array $matrix): array
{
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

$array1 = [
    [1, 2],
    [3, 4],
  ];
foreach ($array1 as $b) echo json_encode($b),"\n";
$res = rotatedMatrix($array1);
foreach ($res as $b) echo json_encode($b),"\n";




