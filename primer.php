<?php

use function Funct\Collection\firstN;

$users = [
  ['name' => 'Tirion', 'birthday' => '1988-11-19'],
  ['name' => 'Sam', 'birthday' => '1999-11-22'],
  ['name' => 'Rob', 'birthday' => '1975-01-11'],
  ['name' => 'Sansa', 'birthday' => '2001-03-20'],
  ['name' => 'Tisha', 'birthday' => '1992-02-27']
];
var_dump(firstN($users));
