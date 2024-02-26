<?php
// Здесь примененине функции in_array как бы наоборот
// Вроде проверяем наличие элемента в массиве $items
// но по факту берем элемент из массива $items и провереяем его значнеие
// в массиве тех значений, которые надо исключить $values
// и установлено значение проверки true значит выполняется строгая проверка типов
namespace App\Arrays;

// BEGIN
function without(array $items, ...$values)
{
    $filtered = array_filter($items, fn($item) => !in_array($item, $values, true));

    // Сбрасываем ключи
    return array_values($filtered);
}
// END