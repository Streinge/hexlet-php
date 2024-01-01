<?php

$array = [];
$key = crc32('key') % 1000;
for ($i = 0; $i <= $key; $i++) {
    $array[] = null;
}
var_dump($array[$key]);
