<?php

$array1 = [1, 2, 3, 4, 5];
$array2 = [7, 8, 9, 10, 11, 12];
$array3 = [3, 4, 5, 6];
$array4 = [16, 100];
$array5 = [5, 11];
$array = [[1, 2, 3, 4, 5], [7, 8, 9, 10, 11, 12], [3, 4, 5, 6]];
[$begin1, $end1] = $array1;
[$begin2, $end2] = $array2;
[$begin3, $end3] = $array3;
[$begin2, $end2] = $array2;
[$begin2, $end2] = $array2;
$new_array = array_merge([1, 2, 3, 4, 5], [7, 8, 9, 10, 11, 12], [3, 4, 5, 6]);

var_dump($new_array);

