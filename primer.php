<?php

require_once __DIR__ . '/vendor/autoload.php';

use function Funct\Collection\firstN;
$mail = 'vovan@hotmail.com';
$a = stripos($mail, '@');

var_dump(substr($mail, $a + 1));
