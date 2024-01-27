<?php

namespace Hexlet\Php;

use function Funct\Collection\flattenAll;

function calculateProbabilities(array $numbers)
{
    $preResult = array_reduce($numbers, function ($acc, $num) use ($numbers) {

        $test = $num;
        $arrayDrops = array_map(function ($key) use ($test, $numbers) {
                return ($numbers[$key] === $test) ? $numbers[$key + 1] ?? null : null;
        }, array_keys($numbers));

        $arrayFilter = array_filter($arrayDrops, fn($arr) => $arr !== null);

        $arrayProbab = array_reduce($arrayFilter, function ($newAcc, $arr) use ($arrayFilter) {
            if (!empty($newAcc[$arr])) {
                $number = round($newAcc[$arr] * count($arrayFilter));
                $newAcc[$arr] = round(($number + 1) / count($arrayFilter), 2);
            } else {
                $newAcc[$arr] = round(1 / count($arrayFilter), 2);
            }
            return $newAcc;
        }, []);
        $acc[$test] = $arrayProbab;
        return $acc;
    }, []);
    
    return $preResult;
}

//var_dump(calculateProbabilities([1, 3, 1, 5, 1]));
/*$expected1 = [
    1 => [3 => 0.5, 5 => 0.5],
    3 => [1 => 1],
    5 => [1 => 1]
];*/

//var_dump(calculateProbabilities([1, 3, 1, 5, 1, 2, 5, 6, 2, 5, 2, 6, 4, 4]));
/*$expected2 = [
    1 => [
        3 => 0.33,
        5 => 0.33,
        2 => 0.33
    ],
    3 => [1 => 1],
    5 => [
        1 => 0.33,
        6 => 0.33,
        2 => 0.33
    ],
    2 => [
        5 => 0.67,
        6 => 0.33
    ],
    6 => [
        2 => 0.5,
        4 => 0.5
    ],
    4 => [4 => 1]
]; */


//var_dump(calculateProbabilities([1, 3, 1, 5, 1, 2, 5, 2, 5, 2, 4, 4, 6]));
/*$expected3 = [
    1 => [
        3 => 0.33,
        5 => 0.33,
        2 => 0.33
    ],
    3 => [1 => 1],
    5 => [
        1 => 0.33,
        2 => 0.67
    ],
    2 => [
        5 => 0.67,
        4 => 0.33
    ],
    4 => [
        4 => 0.5,
        6 => 0.5,
    ],
    6 => [],
];
$this->assertEquals($expected3, $actual3);*/
