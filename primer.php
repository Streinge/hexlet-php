<?php

require_once __DIR__ . '/vendor/autoload.php';

use function Funct\Collection\firstN;
use function Functional\repeat;

$percent = '2001:::';
var_dump(substr_count($percent, ':::'));
