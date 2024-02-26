<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Funct\Collection\flatten;

function getChildren(array $users)
{
    $newNumbers = array_map(fn($users) => $users['children'], $users);
    return flatten($newNumbers);
}

$users = [
    ['name' => 'Tirion', 'children' => [
        ['name' => 'Mira', 'birthday' => '1983-03-23']
    ]],
    ['name' => 'Bronn', 'children' => []],
    ['name' => 'Sam', 'children' => [
        ['name' => 'Aria', 'birthday' => '2012-11-03'],
        ['name' => 'Keit', 'birthday' => '1933-05-14']
    ]],
    ['name' => 'Rob', 'children' => [
        ['name' => 'Tisha', 'birthday' => '2012-11-03']
    ]],
];

var_dump(getChildren($users));
