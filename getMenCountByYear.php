<?php

namespace Hexlet\Php;

function getMenCountByYear(array $users)
{
    $countYears = array_reduce($users, function ($acc, $user) {
        if ($user['gender'] === 'male') {
            $year = date("Y", strtotime($user['birthday']));
            if (array_key_exists($year, $acc)) {
                $acc[$year] += 1;
            } else {
                $acc[$year] = 1;
            }
        }
        return $acc;
    }, []);
    return $countYears;
}

$users = [
    ['name' => 'Bronn', 'gender' => 'male', 'birthday' => '1973-03-23'],
    ['name' => 'Reigar', 'gender' => 'male', 'birthday' => '1973-11-03'],
    ['name' => 'Eiegon',  'gender' => 'male', 'birthday' => '1963-11-03'],
    ['name' => 'Sansa', 'gender' => 'female', 'birthday' => '2012-11-03'],
    ['name' => 'Jon', 'gender' => 'male', 'birthday' => '1980-11-03'],
    ['name' => 'Robb','gender' => 'male', 'birthday' => '1980-05-14'],
    ['name' => 'Tisha', 'gender' => 'female', 'birthday' => '2012-11-03'],
    ['name' => 'Rick', 'gender' => 'male', 'birthday' => '2012-11-03'],
    ['name' => 'Joffrey', 'gender' => 'male', 'birthday' => '1999-11-03'],
    ['name' => 'Edd', 'gender' => 'male', 'birthday' => '1973-11-03']
];

var_dump(getMenCountByYear($users));
