<?php

namespace Hexlet\Php;

function convert($incoming)
{
    //echo $counter . "\n";
    return array_reduce($incoming, function ($acc, $item) {

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
    //echo "Возвращаем аккумулятор \n";
    //var_dump($acc);
        return $acc;
    }, []);
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
print_r(convert($tree4));
