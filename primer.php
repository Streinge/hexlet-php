<?php

$array = ["hi", "how", "are", "you"];
$result = [];

foreach ($array as $key => $value) {
    $result[] = $key;
}

print_r($result);
