<?php

require_once 'buildQueryString.php';

use function Hexlet\Php\buildQueryString;

echo buildQueryString(['per' => 10, 'page' => 1 ]) . "\n";
// → page=1&per=10
