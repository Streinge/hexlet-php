<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use Funct\Collection;

function getManWithLeastFriends(array $users)
{
    if (empty($users)) {
        return null;
    }
    $usersWithFriends = Collection\minValue($users, fn($user) => count($user['friends']));
    return $usersWithFriends;
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

$expected = ['name' => 'Bronn', 'friends' => []];
// $this->assertEquals($expected, getManWithLeastFriends($users));
var_dump(getManWithLeastFriends($users));

$users2 = [
    ['name' => 'Tirion', 'friends' => [
        ['name' => 'Mira', 'gender' => 'female']
    ]],
    ['name' => 'Sam', 'friends' => [
        ['name' => 'Aria', 'gender' => 'female'],
        ['name' => 'Keit', 'gender' => 'female'],
        ['name' => 'Tanisha', 'gender' => 'female']
    ]],
    ['name' => 'Bronn', 'friends' => [
        ['name' => 'Taywin', 'gender' => 'male']
    ]],
    ['name' => 'Rob', 'friends' => [
        ['name' => 'Taywin', 'gender' => 'male'],
        ['name' => 'Keit', 'gender' => 'female'],
        ['name' => 'Ramsey', 'gender' => 'male']
    ]],
];

$expected2 = ['name' => 'Bronn', 'friends' => [
    ['name' => 'Taywin', 'gender' => 'male']
]];

var_dump(getManWithLeastFriends($users2));
