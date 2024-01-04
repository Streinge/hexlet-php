<?php

require_once __DIR__ . '/vendor/autoload.php';

use function Funct\Collection\firstN;
use function Functional\repeat;

$a = array_fill(1, 6, 0);
var_dump($a);

