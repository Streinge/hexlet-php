<?php

namespace Hexlet\Php\buildSnailPath;

function rotatedMatrix(array $matrix): array
// функция поворачивает матрицу против часовой стрелки
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
        // здесь делаем не удаление первой строки,
        // а берем срез из массива с помощью функции array_slice
        $newMatrix = array_slice($newMatrix, 1);
        $newMatrix = rotatedMatrix($newMatrix);
    }
    return $result;
}


$matrix = [
    [1, 2],
    [3, 4],
  ];
echo "Это вывод результата \n";
var_dump(buildSnailPath($matrix));
