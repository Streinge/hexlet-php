<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Funct\Collection\firstN;

function takeOldest(array $users, int $number = 1)
{
    usort($users, fn($a, $b) => $a['birthday'] <=> $b['birthday']);
    return firstN($users, $number);
}


$users = [
    ['name' => 'Tirion', 'birthday' => '1988-11-19'],
    ['name' => 'Sam', 'birthday' => '1999-11-22'],
    ['name' => 'Rob', 'birthday' => '1975-01-11'],
    ['name' => 'Sansa', 'birthday' => '2001-03-20'],
    ['name' => 'Tisha', 'birthday' => '1992-02-27']
  ];
var_dump(takeOldest($users));
