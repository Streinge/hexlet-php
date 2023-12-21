<?php

namespace Hexlet\Php\MyCompact;

function mycompact($coll)
// Функция удаляет элементы с null из массива
{
    $result = [];
    foreach ($coll as $item) {
        if (!is_null($item)) {
            $result[] = $item;
        }
    }

    return $result;
}
