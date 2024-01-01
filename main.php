<?php

require_once 'genDiff.php';

use function Hexlet\Php\genDiff;

$array1 = ['one' => 'eon', 'two' => 'two', 'four' => true];
$array2 = ['two' => 'own', 'zero' => 4, 'four' => true];
$result = genDiff($array1, $array2);
var_dump($result);

// [
//   'one' => 'deleted',
//   'two' => 'changed',
//   'four' => 'unchanged',
//   'zero' => 'added',
// ]
