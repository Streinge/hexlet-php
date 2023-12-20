<?php

$array1 = [];
$array2 = [1, [3, 2], 9];
$type = gettype($array1);
if ($type === 'array') {
    echo $type;
}

$array1 = [...$array2];
print_r($array1);

