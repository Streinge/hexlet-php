<?php
$sum = 0;
$item = [1,2];
$sum += $item[0] <=> $item[1];
print_r($sum);