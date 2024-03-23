<?php

namespace Hexlet\Php;

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

use Carbon\Carbon;

printf("Now: %s", Carbon::now()); // Now: 2018-04-21 13:31:56

echo "\n";

print_r(Carbon::create(2024, 4, 21, 12)->diffForHumans()); // 1 month ago

$nextSummerOlympics = Carbon::createFromDate(2016)->addYears(4);

echo $nextSummerOlympics;

$dt = Carbon::now();
echo "\n";
//var_dump($dt->year(1975)->month(5)->day(21)->hour(22)->minute(32)->second(5)->toDateTimeString());
var_dump($dt->timestamp(169957925)->timezone('Europe/London'));
