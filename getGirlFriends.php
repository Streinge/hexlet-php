<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Funct\Collection\flatten;

function getGirlFriends(array $users)
{
    $friends = flatten(array_map(fn($users) => $users['friends'], $users));
    $GirlFriends = array_filter($friends, fn($friends) => $friends['gender'] === 'female');
    return array_values($GirlFriends);
}

$users = [
    ['name' => 'Tirion', 'friends' => [
        ['name' => 'Mira', 'gender' => 'female'],
        ['name' => 'Ramsey', 'gender' => 'male']
    ]],
    ['name' => 'Bronn', 'friends' => []],
    ['name' => 'Sam', 'friends' => [
        ['name' => 'Aria', 'gender' => 'female'],
        ['name' => 'Keit', 'gender' => 'female']
    ]],
    ['name' => 'Rob', 'friends' => [
        ['name' => 'Taywin', 'gender' => 'male']
    ]],
];

var_dump(getGirlFriends($users));
