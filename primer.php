<?php

require_once __DIR__ . '/vendor/autoload.php';

use function Funct\Collection\firstN;
use function Functional\repeat;

$percent = str_pad((string) (round(0 * 100 / $number)), 2, " ", STR_PAD_LEFT);
var_dump($percent);

