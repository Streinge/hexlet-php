<?php

$array = ["hi", "how", "are", "you"];
$result = [];

foreach ($array as $key => $value) {
    $result[] = $key;
}
echo "result = \n";
print_r($result);
