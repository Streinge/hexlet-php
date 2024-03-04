<?php

namespace Hexlet\Php;

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

use Tightenco\Collect\Support\Collection;

function normalize(array $listCities)
{
    $coll = collect($listCities);
    $filtered = $coll->map(function ($item) {
        return collect($item)->map(function ($item1) {
            return trim(strtolower($item1));
        })->unique()->all();
    });

    $grouped = $filtered->mapToGroups(function ($item) {
        return [$item['country'] => $item['name']];
    });

    return $grouped->all();
}

$raw = [
    [
        'name' => 'istambul',
        'country' => 'turkey'
    ],
    [
        'name' => 'Moscow ',
        'country' => ' Russia'
    ],
    [
        'name' => 'iStambul',
        'country' => 'tUrkey'
    ],
    [
        'name' => 'antalia',
        'country' => 'turkeY '
    ],
    [
        'name' => 'samarA',
        'country' => '  ruSsiA'
    ],
];
$actual = normalize($raw);
print_r($actual);
// $expected = [
//     'russia' => [
//         'moscow', 'samara'
//     ],
//     'turkey' => [
//         'antalia', 'istambul'
//     ]
// ];