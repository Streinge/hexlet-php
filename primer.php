<?php

$matrix = [
    [0, 12, 13, 14],
    [21, 22, 23, 24],
    [31, 32, 33, 34],
    [41, 42, 43, 44],
];

[$numberColumns] = $matrix;

var_dump(empty($matrix[10][10]));



