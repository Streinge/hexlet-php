<?php

namespace Hexlet\Php;

function returnWithoutNested($incoming)
{

    [$first] = $incoming;
    if (is_array($first)) {
        return returnWithoutNested($first);
    } else {
        return $incoming;
    }
}

function convert($incoming, $acc = [])
{
    //echo $counter . "\n";
    foreach ($incoming as $item) {
        $item = returnWithoutNested($item);
        [$key, $second] = $item;
        //echo "Ключ = " . $key . "\n";
        if (is_array($second) && $second !== []) {
            //echo "Запускаем рекурсию" . "\n";
            $value = convert($second);
        } else {
            //echo "Просто присваиваем значения" . "\n";
            $value = $second;
        }
        $acc[$key] = $value;
    }
    //echo "Возвращаем аккумулятор \n";
    //var_dump($acc);
    return $acc;
}
//print_r(convert([['key', [['key2', 'anotherValue']]], ['key2', 'value2']]));
// [ 'key' => ['key2' => 'anotherValue'], 'key2' => 'value2' ]
$tree4 = [
    ['key2', 'value2'],
    ['anotherKey', [
                   ['key2', false],
                   ['innerKey', []],
                   ]],
    ['key', null],
    ['anotherKey2',[
                   ['wow', [
                           ['one', 'two'],
                           ['three', 'four']
                           ]],
                   ['key2', true],
                  ]],
          ];

$tree5 = [];
var_dump(convert($tree5));
