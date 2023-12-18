<?php

namespace Hexlet\Php\Apply;

function apply(array $array, string $operation, int $index=null, string $new=null): array
{
    switch ($operation) {
        case 'reset':
            $array = [];
            break;
        case 'remove':
            unset($array[$index]);
            break;
        case 'change':
            $array[$index] = $new;
            break;
    }
    return $array;
}
$cities = ['moscow', 'london', 'berlin', 'porto'];
 
// Сброс в пустой массив
var_dump(apply($cities, 'reset')); // []
// Удаление значения по индексу
var_dump(apply($cities, 'remove', 1)); // ['moscow', 'berlin', 'porto']
// Изменение значения по индексу
var_dump(apply($cities, 'change', 0, 'miami')); // ['miami', 'london', 'berlin', 'porto']
