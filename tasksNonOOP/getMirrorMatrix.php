<?php

namespace Hexlet\Php\GetMirrorMatrix;

function getMirrorMatrix(array $matrix)
{
    [$firstRow] = $matrix; 
    $numberColumns = count($firstRow);
    $mirrorMatrix = [];
    foreach ($matrix as $row) {
        $beginSlice = array_slice($row, 0, $numberColumns / 2);
        $mirrorMatrix[] = array_merge($beginSlice, array_reverse($beginSlice));
    }
    return $mirrorMatrix;
}

var_dump(getMirrorMatrix([
    [11, 12, 13, 14],
    [21, 22, 23, 24],
    [31, 32, 33, 34],
    [41, 42, 43, 44],
  ]));
