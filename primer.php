<?php

require_once __DIR__ . '/vendor/autoload.php';

use function Funct\Collection\firstN;
use function Functional\repeat;

//$percent = '2001:::';
//var_dump(substr_count($percent, ':::'));

$a = intdiv(2154959208, 256);
$b = intdiv($a, 256);
$c = intdiv($b, 256);
echo $c . ".";
$new = 2154959208 - ($c * 256 * 256 * 256);
$a = intdiv($new, 256);
$b = intdiv($a, 256);
echo $b . ".";
$new = $new - ($b * 256 * 256);
$a = intdiv($new, 256);
echo $a . ".";
$new = $new - ($a * 256);
echo $new;
