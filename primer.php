<?php

require_once __DIR__ . '/vendor/autoload.php';

use function Funct\Collection\firstN;
use function Functional\repeat;

//$percent = '2001:::';
//var_dump(substr_count($percent, ':::'));

$a = [4,5,3];
$b = [4,5,3,1,9,74,2];
var_dump(in_array($b, $a));
