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
use Tightenco\Collect\Support\Collection;

function buildRange($data, $begin, $end)
{
    $collection = collect($data);
    $keyed = $collection->keyBy('date');
    $arrKeyd = $keyed->all();

    $period = collect(\Carbon\CarbonPeriod::create($begin, $end)->toArray());

    $keysNew = $period->map(function ($date) {
        return $date->format('d.m.Y');
    });

    $result = $keysNew->reduce(function ($acc, $key) use ($arrKeyd) {
        $status = $arrKeyd[$key] ?? null;
        return ($status)
            ? array_merge($acc, [$key => ['value' => $arrKeyd[$key]['value'], 'date' => $key]])
            : array_merge($acc, [$key => ['value' => 0, 'date' => $key]]);
    }, []);
    return array_values($result);



    
    //contains('2018-08-11');
    //getDateInterval();
}

$data = [
    [ 'value' => 14, 'date' => '02.08.2018' ],
    [ 'value' => 43, 'date' => '03.08.2018' ],
    [ 'value' => 38, 'date' => '05.08.2018' ],
  ];

$begin = '2018-08-01';
$end = '2018-08-06';

print_r(buildRange($data, $begin, $end));
