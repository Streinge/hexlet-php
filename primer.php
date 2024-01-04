<?php

require_once __DIR__ . '/vendor/autoload.php';

use function Funct\Collection\firstN;
use function Functional\repeat;

$a = [1,2,3,4,5];
$accExt[] = array_reduce($a, function ($accInt, $a1) {
    $accInt[] = $a1;
        var_dump($accInt);
}, []);
var_dump($accExt);
