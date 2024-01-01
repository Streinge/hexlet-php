<?php

require_once 'combine.php';

use function Hexlet\Php\combine;

var_dump(combine([[], [], [], []]));
// [];

var_dump(combine([[ 'a' => 1, 'b' => 2 ], [ 'a' => 3 ]]));
// [ 'a' => [1, 3], 'b' => [2]];

var_dump(combine([
    [ 'a' => 1, 'b' => 2, 'c' => 3 ],
    [],
    [ 'a' => 3, 'b' => 2, 'd' => 5],
    [ 'a' => 6 ],
    [ 'b' => 4, 'c' => 3, 'd' => 2 ],
    [ 'e' => 9 ],
]));
// [
//     'a' => [1, 3, 6],
//     'b' => [2, 4],
//     'c' => [3],
//     'd' => [5, 2],
//     'e' => [9],
// ];
